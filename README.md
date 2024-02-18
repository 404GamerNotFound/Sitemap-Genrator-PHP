# Sitemap Generator Class

The `SitemapGenerator` class is designed to dynamically create sitemaps for websites. It supports adding URLs with optional last modification dates, change frequencies, priorities, alternate language versions, and associated images. This class is particularly useful for SEO purposes, ensuring that search engines can efficiently index your site's pages.

## Features

- **Add URL:** Add new URLs to the sitemap with optional metadata including last modification date, change frequency, priority, alternates, and images.
- **Add Alternate:** Add alternate language versions for existing URLs to support internationalization.
- **Add Image:** Associate images with existing URLs to enhance search engine indexing of your site's visual content.
- **Generate XML:** Outputs the entire sitemap as an XML string, ready to be served to search engines.

## Usage

### Initialization

```php
require_once 'SitemapGenerator.php';
$generator = new SitemapGenerator();
```

### Adding a URL

To add a new URL to the sitemap, use the `addUrl` method. This method allows you to specify the URL's location, last modification date, change frequency, priority, alternate languages, and associated images.

```php
$generator->addUrl(
    'http://example.com/page1',
    '2020-01-01',
    'daily',
    '1.0',
    [['hreflang' => 'en', 'href' => 'http://example.com/page1']],
    [['loc' => 'http://example.com/image1.jpg']]
);
```

### Adding an Alternate Version

If you have alternate language versions of a page, you can add these using the `addAlternate` method. This feature is crucial for multi-language websites, ensuring that search engines understand the relationship between different language versions of the same content.

```php
$generator->addAlternate('http://example.com/page1', 'de', 'http://example.com/page1-de');
```

### Adding an Image

To associate images with a URL, use the `addImage` method. Including images in your sitemap can enhance the indexing of your site's visual content by search engines.

```php
$generator->addImage('http://example.com/page1', 'http://example.com/page1-image.jpg');
```

### Generating XML

Finally, to generate the sitemap XML, use the `generateXML` method. This method compiles all added URLs, alternate versions, and images into a properly formatted XML string according to the sitemap protocol.

```php
$xmlString = $generator->generateXML();
echo $xmlString;
```

## Requirements

- PHP 7.0 or higher is required for this class to function correctly.

## Notes

- Ensure all URLs and image locations are valid and accessible to search engines.
- Utilize the `changefreq` and `priority` values according to how frequently each page is updated and its importance relative to other pages on your site.

## License

This script is licensed under the GNU General Public License version 3 (GPLv3), which allows you to copy, modify, and distribute the software as long as you track changes/dates in source files and keep intact all notices that refer to this License and to the absence of any warranty. For details, see the GNU General Public License.

In addition to the GPLv3 requirements, you must also acknowledge Tony Brüser as the original author of the class in any public-facing material or documentation that utilizes this class. Specifically, any derived work, website, or publication that benefits from the Sitemap Generator Class must include the following acknowledgment:

"Powered by the Sitemap Generator Class, originally developed by Tony Brüser."

This acknowledgment requirement is a custom addition to the GPLv3 license and must be followed in conjunction with the standard GPL provisions.

For the full terms of the GNU General Public License version 3, please refer to the license document or visit [https://www.gnu.org/licenses/gpl-3.0.html](https://www.gnu.org/licenses/gpl-3.0.html).
