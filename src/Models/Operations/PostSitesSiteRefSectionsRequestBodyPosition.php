<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace basekit\SiteBuilder\Models\Operations;


/** Only used when sibling is present, valid values are above or below */
enum PostSitesSiteRefSectionsRequestBodyPosition: string
{
    case Above = 'above';
    case Below = 'below';
}
