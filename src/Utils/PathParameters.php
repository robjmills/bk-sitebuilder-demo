<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace basekit\SiteBuilder\Utils;

use ReflectionProperty;

class PathParameters
{
    /**
     * @param string $type
     * @param mixed $pathParams
     * @param array<string, array<string, array<string, string>>> $globals
     * @return array<string, string>
     */
    public function parsePathParams(string $type, mixed $pathParams, array $globals): array
    {
        $parsed = [];

        $fields = array_keys(get_class_vars($type));

        foreach ($fields as $field) {
            $value = $pathParams !== null ? $pathParams->{$field} : null;
            $value = populateGlobal($value, 'pathParam', $field, $globals);

            if ($value === null) {
                continue;
            }

            $requestMetadata = RequestBodies::parseRequestMetadata(new ReflectionProperty($type, $field));
            if ($requestMetadata !== null) {
                continue;
            }

            $metadata = $this->parsePathParamsMetadata(new ReflectionProperty($type, $field));
            if ($metadata === null) {
                continue;
            }

            if (!empty($metadata->serialization)) {
                $parsed = array_merge_recursive($parsed, $this->parseSerializationParams($metadata, $value));
            } else {
                switch ($metadata->style) {
                    case "simple":
                        $parsed = array_merge_recursive($parsed, $this->parseSimplePathParams($metadata, $value));
                        break;
                    default:
                        throw new \Exception("Unsupported style: " . $metadata->style);
                }
            }
        }

        return $parsed;
    }

    /**
     * @param ParamsMetadata $metadata
     * @param mixed $value
     * @return array<string, string>
     */
    private function parseSimplePathParams(ParamsMetadata $metadata, mixed $value): array
    {
        $pathParams = [];

        switch (gettype($value)) {
            case "object":
                $vals = [];

                foreach ($value as $field => $fieldValue) { /** @phpstan-ignore-line */
                    if ($fieldValue === null) {
                        continue;
                    }

                    $fieldMetadata = $this->parsePathParamsMetadata(new ReflectionProperty(get_class($value), $field));
                    if ($fieldMetadata === null) {
                        continue;
                    }

                    if ($metadata->explode) {
                        $vals[] = sprintf("%s=%s", $fieldMetadata->name, valToString($fieldValue));
                    } else {
                        $vals[] = sprintf("%s,%s", $fieldMetadata->name, valToString($fieldValue));
                    }
                }

                $pathParams[$metadata->name] = implode(",", $vals);
                break;
            case "array":
                $vals = [];

                if (array_is_list($value)) {
                    foreach ($value as $val) {
                        $vals[] = valToString($val);
                    }
                } else {
                    foreach ($value as $key => $val) {
                        if ($metadata->explode) {
                            $vals[] = sprintf("%s=%s", $key, valToString($val));
                        } else {
                            $vals[] = sprintf("%s,%s", $key, valToString($val));
                        }
                    }
                }

                $pathParams[$metadata->name] = implode(",", $vals);
                break;
            default:
                $pathParams[$metadata->name] = valToString($value);
                break;
        }

        return $pathParams;
    }

    private function parsePathParamsMetadata(ReflectionProperty $property): ParamsMetadata | null
    {
        $metadataStr = SpeakeasyMetadata::find($property->getAttributes(SpeakeasyMetadata::class), "pathParam");
        if ($metadataStr === null) {
            return null;
        }

        $metadata = ParamsMetadata::parse($metadataStr);
        if ($metadata === null) {
            return null;
        }

        return $metadata;
    }

    /**
     * @param ParamsMetadata $metadata
     * @param mixed $value
     * @return array<string, string>
     */
    private function parseSerializationParams(ParamsMetadata $metadata, mixed $value): array
    {
        $params = [];

        switch ($metadata->serialization) {
            case "json":
                $serializer = JSON::createSerializer();
                $params[$metadata->name] = urlencode($serializer->serialize($value, 'json'));
                break;
            default:
                throw new \Exception("Unsupported serialization: " . $metadata->serialization);
        }

        return $params;
    }
}
