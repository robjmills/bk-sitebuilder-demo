<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace basekit\SiteBuilder\Models\Operations;

use \basekit\SiteBuilder\Utils\SpeakeasyMetadata;
class PostSitesSiteRefSectionsRequest
{
	#[SpeakeasyMetadata('request:mediaType=application/json')]
    public ?PostSitesSiteRefSectionsRequestBody $requestBody = null;
    
    /**
     * Reference of the page on the site
     * 
     * @var int $pageRef
     */
	#[SpeakeasyMetadata('pathParam:style=simple,explode=false,name=pageRef')]
    public int $pageRef;
    
    /**
     * Reference of the site
     * 
     * @var int $siteRef
     */
	#[SpeakeasyMetadata('pathParam:style=simple,explode=false,name=siteRef')]
    public int $siteRef;
    
	public function __construct()
	{
		$this->requestBody = null;
		$this->pageRef = 0;
		$this->siteRef = 0;
	}
}
