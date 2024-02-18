/**
 * Sitemap Generator Class
 *
 * This class is designed for generating XML sitemaps dynamically. It supports adding URLs with optional
 * last modification date, change frequency, priority, alternate language versions, and associated images.
 *
 * @author Tony Brüser
 */
class SitemapGenerator {
    /**
     * Array to hold the URLs and their associated data.
     *
     * @var array
     */
    private $urls = [];

    /**
     * Adds a new URL and optionally associated data to the sitemap.
     *
     * @param string $loc The location (URL) to add.
     * @param string|null $lastMod The last modification date of the URL. Optional.
     * @param string|null $changeFreq The frequency of changes to the URL. Optional.
     * @param string|null $priority The priority of the URL relative to other URLs. Optional.
     * @param array $alternates Alternate language versions of the URL. Optional.
     * @param array $images Images associated with the URL. Optional.
     */
    public function addUrl($loc, $lastMod = null, $changeFreq = null, $priority = null, $alternates = [], $images = []) {
        $this->urls[$loc] = [
            'loc' => $loc,
            'lastmod' => $lastMod,
            'changefreq' => $changeFreq,
            'priority' => $priority,
            'alternates' => $alternates,
            'images' => $images // Newly added
        ];
    }

    /**
     * Adds an alternate language version to an existing URL.
     *
     * @param string $loc The original URL to add an alternate version for.
     * @param string $hreflang The language of the alternate version.
     * @param string $href The alternate URL.
     */
    public function addAlternate($loc, $hreflang, $href) {
        if (!isset($this->urls[$loc])) {
            // Error handling if the URL does not exist
            return;
        }
        $this->urls[$loc]['alternates'][] = ['hreflang' => $hreflang, 'href' => $href];
    }

    /**
     * Adds an image to an existing URL.
     *
     * @param string $loc The URL to associate the image with.
     * @param string $imageLoc The location (URL) of the image.
     */
    public function addImage($loc, $imageLoc) {
        if (!isset($this->urls[$loc])) {
            // Error handling if the URL does not exist
            return;
        }
        $this->urls[$loc]['images'][] = ['loc' => $imageLoc];
    }

    /**
     * Generates the sitemap as an XML string.
     *
     * Initializes the XML document with the required namespaces and iterates through all URLs
     * and their associated data to build the sitemap XML.
     *
     * @return string The generated XML sitemap as a string.
     */
    public function generateXML() {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"></urlset>');

        foreach ($this->urls as $url) {
            $urlElement = $xml->addChild('url');
            $urlElement->addChild('loc', htmlspecialchars($url['loc']));
            if ($url['lastmod']) {
                $urlElement->addChild('lastmod', $url['lastmod']);
            }
            if ($url['changefreq']) {
                $urlElement->addChild('changefreq', $url['changefreq']);
            }
            if ($url['priority']) {
                $urlElement->addChild('priority', $url['priority']);
            }

            foreach ($url['alternates'] as $alternate) {
                $link = $urlElement->addChild('link', null, 'http://www.w3.org/1999/xhtml');
                $link->addAttribute('rel', 'alternate');
                $link->addAttribute('hreflang', $alternate['hreflang']);
                $link->addAttribute('href', htmlspecialchars($alternate['href']));
            }

            foreach ($url['images'] as $image) {
                $imageElement = $urlElement->addChild('image', null, 'http://www.google.com/schemas/sitemap-image/1.1');
                $imageElement->addChild('loc', htmlspecialchars($image['loc']), 'http://www.google.com/schemas/sitemap-image/1.1');
            }
        }

        return $xml->asXML();
    }
}
