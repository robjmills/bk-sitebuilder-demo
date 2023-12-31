<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace basekit\SiteBuilder\Models\Operations;

use \basekit\SiteBuilder\Utils\SpeakeasyMetadata;
class PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequest
{
	#[SpeakeasyMetadata('request:mediaType=application/json')]
    public ?PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequestBody $requestBody = null;
    
    /**
     * Reference of the page on the site
     * 
     * @var int $pageRef
     */
	#[SpeakeasyMetadata('pathParam:style=simple,explode=false,name=pageRef')]
    public int $pageRef;
    
    /**
     * Reference of the section on the page
     * 
     * @var string $sectionRef
     */
	#[SpeakeasyMetadata('pathParam:style=simple,explode=false,name=sectionRef')]
    public string $sectionRef;
    
    /**
     * Reference of the site
     * 
     * @var int $siteRef
     */
	#[SpeakeasyMetadata('pathParam:style=simple,explode=false,name=siteRef')]
    public int $siteRef;
    
    /**
     * Reference of the widget in the section
     * 
     * @var int $widgetRef
     */
	#[SpeakeasyMetadata('pathParam:style=simple,explode=false,name=widgetRef')]
    public int $widgetRef;
    
	public function __construct()
	{
		$this->requestBody = null;
		$this->pageRef = 0;
		$this->sectionRef = "";
		$this->siteRef = 0;
		$this->widgetRef = 0;
	}
}
