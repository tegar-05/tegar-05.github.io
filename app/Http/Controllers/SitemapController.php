<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Generate main sitemap.xml
     */
    public function index()
    {
        $sitemap = Cache::remember('sitemap_main', 43200, function () { // 12 hours
            $urls = [];

            // Static pages
            $staticPages = [
                ['url' => url('/'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
                ['url' => url('/menu'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
                ['url' => url('/florist'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
                ['url' => url('/about'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
                ['url' => url('/contact'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
                ['url' => url('/reservation'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ];

            $urls = array_merge($urls, $staticPages);

            // Categories
            $categories = Category::all();
            foreach ($categories as $category) {
                $urls[] = [
                    'url' => url('/menu?category=' . urlencode($category->name)),
                    'lastmod' => $category->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8'
                ];
            }

            // Products
            $products = Product::where('is_active', true)->get();
            foreach ($products as $product) {
                $urls[] = [
                    'url' => url('/menu?search=' . urlencode($product->name)),
                    'lastmod' => $product->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6'
                ];
            }

            return $urls;
        });

        return response()->view('sitemap', compact('sitemap'))->header('Content-Type', 'text/xml');
    }

    /**
     * Generate sitemap-static.xml
     */
    public function static()
    {
        $sitemap = Cache::remember('sitemap_static', 43200, function () {
            return [
                ['url' => url('/'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
                ['url' => url('/menu'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
                ['url' => url('/florist'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
                ['url' => url('/about'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
                ['url' => url('/contact'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
                ['url' => url('/reservation'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ];
        });

        return response()->view('sitemap', compact('sitemap'))->header('Content-Type', 'text/xml');
    }

    /**
     * Generate robots.txt
     */
    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";
        $content .= "Sitemap: " . url('/sitemap-static.xml') . "\n";

        return response($content)->header('Content-Type', 'text/plain');
    }
}
