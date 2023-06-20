<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace basekit\SiteBuilder\Models\Operations;


/**
 * GetSitesSiteRefSections200ApplicationJSON - OK
 * 
 * @package basekit\SiteBuilder\Models\Operations
 * @access public
 */
class GetSitesSiteRefSections200ApplicationJSON
{
    /**
     * $sections
     * 
     * @var ?array<\basekit\SiteBuilder\Models\Shared\SectionList> $sections
     */
	#[\JMS\Serializer\Annotation\SerializedName('sections')]
    #[\JMS\Serializer\Annotation\Type('array<basekit\SiteBuilder\Models\Shared\SectionList>')]
    #[\JMS\Serializer\Annotation\SkipWhenEmpty]
    public ?array $sections = null;
    
	public function __construct()
	{
		$this->sections = null;
	}
}