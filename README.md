# basekit/bk-sitebuilder-demo

<!-- Start SDK Installation -->
## SDK Installation

### Composer

To install the SDK first add the below to your `composer.json` file:

```json
{
    "repositories": [
        {
            "type": "github",
            "url": "https://github.com/robjmills/bk-sitebuilder-demo.git"
        }
    ],
    "require": {
        "basekit/bk-sitebuilder-demo": "*"
    }
}
```

Then run the following command:

```bash
composer update
```
<!-- End SDK Installation -->

## SDK Example Usage
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

<!-- Start SDK Available Operations -->
## Available Resources and Operations

### [SiteBuilder SDK](docs/sdks/sitebuilder/README.md)

* [deleteSitesSiteRefSectionsUniqueId](docs/sdks/sitebuilder/README.md#deletesitessiterefsectionsuniqueid) - Delete section
* [getSitesSiteRefSections](docs/sdks/sitebuilder/README.md#getsitessiterefsections) - Get sections
* [postSitesSiteRefSections](docs/sdks/sitebuilder/README.md#postsitessiterefsections) - Create new section
* [putSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRef](docs/sdks/sitebuilder/README.md#putsitessiterefpagespagerefsectionssectionrefwidgetswidgetref) - Update widget
<!-- End SDK Available Operations -->

### Maturity

This SDK is in beta, and there may be breaking changes between versions without a major version update. Therefore, we recommend pinning usage
to a specific package version. This way, you can install the same version each time without breaking changes unless you are intentionally
looking for the latest version.

### Contributions

While we value open-source contributions to this SDK, this library is generated programmatically.
Feel free to open a PR or a Github issue as a proof of concept and we'll do our best to include it in a future release !

### SDK Created by [Speakeasy](https://docs.speakeasyapi.dev/docs/using-speakeasy/client-sdks)
