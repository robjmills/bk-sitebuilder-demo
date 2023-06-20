# SiteBuilder SDK

## Overview

### Available Operations

* [deleteSitesSiteRefSectionsUniqueId](#deletesitessiterefsectionsuniqueid) - Delete section
* [getSitesSiteRefSections](#getsitessiterefsections) - Get sections
* [postSitesSiteRefSections](#postsitessiterefsections) - Create new section
* [putSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRef](#putsitessiterefpagespagerefsectionssectionrefwidgetswidgetref) - Update widget

## deleteSitesSiteRefSectionsUniqueId

Delete a section, and its child widgets, by the section's sectionRef

### Example Usage

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
    $request->pageRef = 844266;
    $request->sectionRef = 'unde';
    $request->siteRef = 857946;

    $response = $sdk->siteBuilder->deleteSitesSiteRefSectionsUniqueId($request);

    if ($response->statusCode === 200) {
        // handle response
    }
} catch (Exception $e) {
    // handle exception
}
```

### Parameters

| Parameter                                                                                                                                                | Type                                                                                                                                                     | Required                                                                                                                                                 | Description                                                                                                                                              |
| -------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                                               | [\basekit\SiteBuilder\Models\Operations\DeleteSitesSiteRefSectionsUniqueIdRequest](../../models/operations/DeleteSitesSiteRefSectionsUniqueIdRequest.md) | :heavy_check_mark:                                                                                                                                       | The request object to use for the request.                                                                                                               |


### Response

**[?\basekit\SiteBuilder\Models\Operations\DeleteSitesSiteRefSectionsUniqueIdResponse](../../models/operations/DeleteSitesSiteRefSectionsUniqueIdResponse.md)**


## getSitesSiteRefSections

Retrieve a list of sections on a given page

### Example Usage

```php
<?php

declare(strict_types=1);
require_once 'vendor/autoload.php';

use \basekit\SiteBuilder\SiteBuilder;
use \basekit\SiteBuilder\Models\Operations\GetSitesSiteRefSectionsRequest;

$sdk = SiteBuilder::builder()
    ->build();

try {
    $request = new GetSitesSiteRefSectionsRequest();
    $request->pageRef = 544883;
    $request->siteRef = 847252;

    $response = $sdk->siteBuilder->getSitesSiteRefSections($request);

    if ($response->getSitesSiteRefSections200ApplicationJSONObject !== null) {
        // handle response
    }
} catch (Exception $e) {
    // handle exception
}
```

### Parameters

| Parameter                                                                                                                          | Type                                                                                                                               | Required                                                                                                                           | Description                                                                                                                        |
| ---------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                         | [\basekit\SiteBuilder\Models\Operations\GetSitesSiteRefSectionsRequest](../../models/operations/GetSitesSiteRefSectionsRequest.md) | :heavy_check_mark:                                                                                                                 | The request object to use for the request.                                                                                         |


### Response

**[?\basekit\SiteBuilder\Models\Operations\GetSitesSiteRefSectionsResponse](../../models/operations/GetSitesSiteRefSectionsResponse.md)**


## postSitesSiteRefSections

Add a section to a given site page

### Example Usage

```php
<?php

declare(strict_types=1);
require_once 'vendor/autoload.php';

use \basekit\SiteBuilder\SiteBuilder;
use \basekit\SiteBuilder\Models\Operations\PostSitesSiteRefSectionsRequest;
use \basekit\SiteBuilder\Models\Operations\PostSitesSiteRefSectionsRequestBody;
use \basekit\SiteBuilder\Models\Operations\PostSitesSiteRefSectionsRequestBodyPosition;

$sdk = SiteBuilder::builder()
    ->build();

try {
    $request = new PostSitesSiteRefSectionsRequest();
    $request->requestBody = new PostSitesSiteRefSectionsRequestBody();
    $request->requestBody->position = PostSitesSiteRefSectionsRequestBodyPosition::Above;
    $request->requestBody->siblingRef = 'error';
    $request->requestBody->template = 'image_text_1a';
    $request->pageRef = 645894;
    $request->siteRef = 384382;

    $response = $sdk->siteBuilder->postSitesSiteRefSections($request);

    if ($response->postSitesSiteRefSections201ApplicationJSONObject !== null) {
        // handle response
    }
} catch (Exception $e) {
    // handle exception
}
```

### Parameters

| Parameter                                                                                                                            | Type                                                                                                                                 | Required                                                                                                                             | Description                                                                                                                          |
| ------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                                                           | [\basekit\SiteBuilder\Models\Operations\PostSitesSiteRefSectionsRequest](../../models/operations/PostSitesSiteRefSectionsRequest.md) | :heavy_check_mark:                                                                                                                   | The request object to use for the request.                                                                                           |


### Response

**[?\basekit\SiteBuilder\Models\Operations\PostSitesSiteRefSectionsResponse](../../models/operations/PostSitesSiteRefSectionsResponse.md)**


## putSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRef

Update the data in a widget contained in a section

### Example Usage

```php
<?php

declare(strict_types=1);
require_once 'vendor/autoload.php';

use \basekit\SiteBuilder\SiteBuilder;
use \basekit\SiteBuilder\Models\Operations\PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequest;
use \basekit\SiteBuilder\Models\Operations\PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequestBody;

$sdk = SiteBuilder::builder()
    ->build();

try {
    $request = new PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequest();
    $request->requestBody = new PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequestBody();
    $request->pageRef = 437587;
    $request->sectionRef = 'magnam';
    $request->siteRef = 891773;
    $request->widgetRef = 56713;

    $response = $sdk->siteBuilder->putSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRef($request);

    if ($response->widget !== null) {
        // handle response
    }
} catch (Exception $e) {
    // handle exception
}
```

### Parameters

| Parameter                                                                                                                                                                                                      | Type                                                                                                                                                                                                           | Required                                                                                                                                                                                                       | Description                                                                                                                                                                                                    |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                                                                                                     | [\basekit\SiteBuilder\Models\Operations\PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequest](../../models/operations/PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefRequest.md) | :heavy_check_mark:                                                                                                                                                                                             | The request object to use for the request.                                                                                                                                                                     |


### Response

**[?\basekit\SiteBuilder\Models\Operations\PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefResponse](../../models/operations/PutSitesSiteRefPagesPageRefSectionsSectionRefWidgetsWidgetRefResponse.md)**

