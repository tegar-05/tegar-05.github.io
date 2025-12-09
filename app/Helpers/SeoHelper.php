<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Generate dynamic meta title
     */
    public static function getTitle($customTitle = null)
    {
        $baseTitle = 'Madame Djeli Cafe & Flores';
        return $customTitle ? $customTitle . ' | ' . $baseTitle : $baseTitle;
    }

    /**
     * Generate dynamic meta description
     */
    public static function getDescription($customDescription = null)
    {
        return $customDescription ?: 'Madame Djeli menghadirkan pengalaman unik menggabungkan aroma kopi pilihan dengan keindahan seni floral. Tempat premium untuk menikmati kopi, makanan, dan rangkaian bunga di Bandung.';
    }

    /**
     * Generate meta keywords
     */
    public static function getKeywords($customKeywords = [])
    {
        $defaultKeywords = ['cafe', 'kopi', 'florist', 'bunga', 'bandung', 'madame djeli', 'premium', 'elegant'];
        return implode(', ', array_merge($customKeywords, $defaultKeywords));
    }

    /**
     * Generate Open Graph meta tags
     */
    public static function getOpenGraph($title = null, $description = null, $image = null, $url = null, $type = 'website')
    {
        $og = [
            'og:title' => self::getTitle($title),
            'og:description' => self::getDescription($description),
            'og:image' => $image ?: asset('images/og-default.jpg'),
            'og:url' => $url ?: url()->current(),
            'og:type' => $type,
            'og:site_name' => 'Madame Djeli Cafe & Flores',
        ];

        return $og;
    }

    /**
     * Generate Twitter Card meta tags
     */
    public static function getTwitterCard($title = null, $description = null, $image = null)
    {
        return [
            'twitter:card' => 'summary_large_image',
            'twitter:title' => self::getTitle($title),
            'twitter:description' => self::getDescription($description),
            'twitter:image' => $image ?: asset('images/twitter-default.jpg'),
            'twitter:site' => '@MadameDjeli', // Replace with actual Twitter handle
        ];
    }

    /**
     * Generate canonical URL
     */
    public static function getCanonicalUrl()
    {
        return url()->current();
    }

    /**
     * Generate Schema.org JSON-LD for Organization
     */
    public static function getOrganizationSchema()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Madame Djeli Cafe & Flores',
            'url' => url('/'),
            'logo' => asset('images/logo.png'),
            'description' => self::getDescription(),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Melati Indah No. 21',
                'addressLocality' => 'Bandung',
                'addressRegion' => 'Jawa Barat',
                'postalCode' => '40211',
                'addressCountry' => 'ID'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+62-22-1234567',
                'contactType' => 'customer service'
            ],
            'sameAs' => [
                'https://www.instagram.com/madamedjeli',
                'https://www.facebook.com/madamedjeli'
            ]
        ];
    }

    /**
     * Generate Schema.org JSON-LD for Website
     */
    public static function getWebsiteSchema()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Madame Djeli Cafe & Flores',
            'url' => url('/'),
            'description' => self::getDescription(),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/menu?search={search_term_string}'),
                'query-input' => 'required name=search_term_string'
            ]
        ];
    }

    /**
     * Generate Schema.org JSON-LD for Product
     */
    public static function getProductSchema($product)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $product->description,
            'image' => $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg'),
            'offers' => [
                '@type' => 'Offer',
                'price' => $product->price,
                'priceCurrency' => 'IDR',
                'availability' => $product->is_active ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'
            ],
            'brand' => [
                '@type' => 'Brand',
                'name' => 'Madame Djeli'
            ]
        ];
    }

    /**
     * Generate Schema.org JSON-LD for BreadcrumbList
     */
    public static function getBreadcrumbSchema($breadcrumbs = [])
    {
        $items = [];
        $position = 1;

        foreach ($breadcrumbs as $name => $url) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $name,
                'item' => $url
            ];
            $position++;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items
        ];
    }
}
