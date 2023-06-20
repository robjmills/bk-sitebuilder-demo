<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace basekit\SiteBuilder\Utils;

use ReflectionProperty;

class RequestBodies
{
    const SERIALIZATION_METHOD_TO_CONTENT_TYPE = [
        'json' => 'application/json',
        'form' => 'application/x-www-form-urlencoded',
        'multipart' => 'multipart/form-data',
        'raw' => 'application/octet-stream',
        'string' => 'text/plain',
    ];

    /**
     * @param mixed $request
     * @param string $requestFieldName
     * @param string $serializationMethod
     * @return array<string, mixed>|null
     */
    public function serializeRequestBody(mixed $request, string $requestFieldName, string $serializationMethod): array | null
    {
        if ($request === null) {
            return null;
        }

        if (gettype($request) !== 'object' || !property_exists($request, $requestFieldName)) {
            return $this->serializeContentType($requestFieldName, RequestBodies::SERIALIZATION_METHOD_TO_CONTENT_TYPE[$serializationMethod], $request);
        }

        $requestVal = $request->{$requestFieldName};
        if ($requestVal === null) {
            return null;
        }

        $metadata = RequestBodies::parseRequestMetadata(new ReflectionProperty(get_class($request), $requestFieldName));
        if ($metadata === null) {
            throw new \Exception("Missing request metadata for field $requestFieldName");
        }

        return $this->serializeContentType($requestFieldName, $metadata->mediaType, $requestVal);
    }

    /**
     * @param string $fieldName
     * @param string $mediaType
     * @param mixed $value
     * @return array<string, mixed>|null
     */
    private function serializeContentType(string $fieldName, string $mediaType, mixed $value): array | null
    {
        if ($value === null) {
            return null;
        }

        $options = [];

        if (preg_match('/(application|text)\/.*?\+*json.*/', $mediaType)) {
            $serializer = JSON::createSerializer();
            $options['body'] = $serializer->serialize($value, 'json');
        } else if (preg_match('/multipart\/.*/', $mediaType)) {
            return $this->serializeMultipart($value);
        } else if (preg_match('/application\/x-www-form-urlencoded.*/', $mediaType)) {
            return $this->serializeFormData($fieldName, $value);
        } else {
            $type = gettype($value);
            switch ($type) {
                case 'string':
                    $options['body'] = $value;
                    break;
                default:
                    throw new \Exception("Invalid request body type $type for field $fieldName");
            }
        }

        return $options;
    }

    /**
     * @param mixed $value
     * @return array<string, mixed>
     */
    private function serializeMultipart(mixed $value): array
    {
        $options = [
            'multipart' => [],
        ];

        foreach ($value as $field => $val) {
            if ($val === null) {
                continue;
            }

            $metadata = $this->parseMultipartMetadata(new ReflectionProperty(get_class($value), $field));
            if ($metadata === null) {
                continue;
            }

            if ($metadata->file) {
                $options['multipart'][] = $this->serializeMultipartFile($val);
            } else if ($metadata->json) {
                $serializer = JSON::createSerializer();
                $options['multipart'][] = [
                    'name' => $metadata->name,
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'contents' => $serializer->serialize($val, 'json'),
                ];
            } else {
                $dateTimeFormat = $metadata->dateTimeFormat;

                if (gettype($val) === 'array' && array_is_list($val)) {
                    foreach ($value as $item) {
                        $options['multipart'][] = [
                            'name' => $metadata->name . '[]',
                            'contents' => valToString($item, $dateTimeFormat)
                        ];
                    }
                } else {
                    $options['multipart'][] = [
                        'name' => $metadata->name,
                        'contents' => valToString($val, $dateTimeFormat),
                    ];
                }
            }
        }

        return $options;
    }

    /**
     * @param mixed $value
     * @return array<string, mixed>
     */
    private function serializeMultipartFile(mixed $value): array
    {
        if (gettype($value) != 'object') {
            throw new \Exception("Invalid type for multipart/form-data file");
        }

        $name = "";
        $filename = "";
        $content = "";

        foreach ($value as $field => $val) { /** @phpstan-ignore-line */
            if ($val === null) {
                continue;
            }

            $metadata = $this->parseMultipartMetadata(new ReflectionProperty(get_class($value), $field));
            if ($metadata === null || (!$metadata->content && empty($metadata->name))) {
                continue;
            }

            if ($metadata->content) {
                $content = $val;
            } else {
                $name = $metadata->name;
                $filename = $val;
            }
        }

        if (empty($name) || empty($filename) || empty($content)) {
            throw new \Exception("Invalid multipart/form-data file");
        }

        return [
            'name' => $name,
            'contents' => $content,
            'filename' => $filename,
        ];
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @return array<string, mixed>
     */
    private function serializeFormData(string $fieldName, mixed $value): array
    {
        $options = [
            'form_params' => [],
        ];

        switch (gettype($value)) {
            case 'object':
                foreach ($value as $field => $val) { /** @phpstan-ignore-line */
                    if ($val === null) {
                        continue;
                    }

                    $metadata = $this->parseFormMetadata(new ReflectionProperty(get_class($value), $field));
                    if ($metadata === null) {
                        continue;
                    }

                    if ($metadata->json) {
                        $serializer = JSON::createSerializer();
                        $options['form_params'][$metadata->name] = $serializer->serialize($val, 'json');
                    } else {
                        switch ($metadata->style) {
                            case 'form':
                                $values = $this->serializeForm($metadata, $val);
                                foreach ($values as $k => $v) {
                                    $options['form_params'][$k] = $v;
                                }
                                break;
                            default:
                                throw new \Exception("Invalid form style for field $field");
                        }
                    }
                }
                break;
            case 'array':
                if (array_is_list($value)) {
                    throw new \Exception("Invalid request body type for field $fieldName");
                } else {
                    foreach ($value as $k => $v) {
                        $options['form_params'][$k] = valToString($v);
                    }
                }
                break;
            default:
                throw new \Exception("Invalid request body type for field $fieldName");
        }

        return $options;
    }

    /**
     * @param FormMetadata $metadata
     * @param mixed $value
     * @return array<string, mixed>
     */
    private function serializeForm(FormMetadata $metadata, mixed $value): array
    {
        $values = [];

        $dateTimeFormat = $metadata->dateTimeFormat;

        switch (gettype($value)) {
            case 'object':
                switch (get_class($value)) {
                    case 'DateTime':
                        $values[$metadata->name] = valToString($value, $dateTimeFormat);
                        break;
                    default:
                        if (is_a($value, \BackedEnum::class, true)) {
                            $values[$metadata->name] = valToString($value);
                        } else {
                            $items = [];

                            foreach ($value as $field => $val) { /** @phpstan-ignore-line */
                                if ($val === null) {
                                    continue;
                                }

                                $fieldMetadata = $this->parseFormMetadata(new ReflectionProperty(get_class($value), $field));
                                if ($fieldMetadata === null || empty($fieldMetadata->name)) {
                                    continue;
                                }

                                if ($metadata->explode) {
                                    $values[$fieldMetadata->name] = valToString($val, $fieldMetadata->dateTimeFormat);
                                } else {
                                    $items[] = sprintf('%s,%s', $fieldMetadata->name, valToString($val));
                                }
                            }

                            if (count($items) > 0) {
                                $values[$metadata->name] = implode(',', $items);
                            }
                        }
                        break;
                }
                break;
            case 'array':
                if (array_is_list($value)) {
                    foreach ($value as $v) {
                        $values[$metadata->name] = valToString($v, $dateTimeFormat);
                    }
                } else {
                    $items = [];

                    foreach ($value as $k => $v) {
                        if ($metadata->explode) {
                            $values[$k] = valToString($v, $dateTimeFormat);
                        } else {
                            $items[] = sprintf('%s,%s', $k, valToString($v, $dateTimeFormat));
                        }
                    }

                    if (count($items) > 0) {
                        $values[$metadata->name] = implode(',', $items);
                    }
                }
                break;
            default:
                $values[$metadata->name] = valToString($value, $dateTimeFormat);
                break;
        }

        return $values;
    }

    public static function parseRequestMetadata(ReflectionProperty $property): RequestMetadata | null
    {
        $attributes = $property->getAttributes(SpeakeasyMetadata::class);
        if (count($attributes) !== 1) {
            return null;
        }

        $arguments = $attributes[0]->getArguments();
        if (count($arguments) !== 1) {
            return null;
        }

        $metadata = RequestMetadata::parse($arguments[0]);
        if ($metadata === null) {
            return null;
        }

        return $metadata;
    }

    private function parseMultipartMetadata(ReflectionProperty $property): MultipartMetadata | null
    {
        $metadataStr = SpeakeasyMetadata::find($property->getAttributes(SpeakeasyMetadata::class), "multipartForm");
        if ($metadataStr === null) {
            return null;
        }

        $metadata = MultipartMetadata::parse($metadataStr);
        if ($metadata === null) {
            return null;
        }

        return $metadata;
    }

    private function parseFormMetadata(ReflectionProperty $property): FormMetadata | null
    {
        $metadataStr = SpeakeasyMetadata::find($property->getAttributes(SpeakeasyMetadata::class), "form");
        if ($metadataStr === null) {
            return null;
        }

        $metadata = FormMetadata::parse($metadataStr);
        if ($metadata === null) {
            return null;
        }

        return $metadata;
    }
}
