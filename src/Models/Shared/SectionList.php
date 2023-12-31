<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace basekit\SiteBuilder\Models\Shared;


class SectionList
{
	#[\JMS\Serializer\Annotation\SerializedName('ref')]
    #[\JMS\Serializer\Annotation\Type('string')]
    public string $ref;
    
	#[\JMS\Serializer\Annotation\SerializedName('template')]
    #[\JMS\Serializer\Annotation\Type('string')]
    public string $template;
    
	public function __construct()
	{
		$this->ref = "";
		$this->template = "";
	}
}
