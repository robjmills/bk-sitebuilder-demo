<!-- Start SDK Example Usage -->
```php
<?php

declare(strict_types=1);
require_once 'vendor/autoload.php';

use \basekit\SiteBuilder\SiteBuilder;
use \basekit\SiteBuilder\Models\Operations\DeleteSitesSiteRefSectionsUniqueIdRequest;

$sdk = SiteBuilder::builder()
    ->build();

try {
    $request = new DeleteSitesSiteRefSectionsUniqueIdRequest();
    $request->pageRef = 548814;
    $request->sectionRef = 'provident';
    $request->siteRef = 715190;

    $response = $sdk->deleteSitesSiteRefSectionsUniqueId($request);

    if ($response->statusCode === 200) {
        // handle response
    }
} catch (Exception $e) {
    // handle exception
}
```
<!-- End SDK Example Usage -->