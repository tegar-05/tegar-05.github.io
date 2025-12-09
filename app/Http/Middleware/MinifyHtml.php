<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only minify HTML responses
        if ($response->headers->get('Content-Type') === 'text/html; charset=UTF-8' ||
            str_contains($response->headers->get('Content-Type'), 'text/html')) {

            $content = $response->getContent();

            // Minify HTML
            $content = $this->minifyHtml($content);

            $response->setContent($content);
        }

        return $response;
    }

    /**
     * Minify HTML content
     */
    private function minifyHtml($html)
    {
        // Remove comments
        $html = preg_replace('/<!--[^\[](.*?)-->/s', '', $html);

        // Remove whitespace between tags
        $html = preg_replace('/>\s+</', '><', $html);

        // Remove multiple spaces
        $html = preg_replace('/\s+/', ' ', $html);

        // Remove spaces around tags
        $html = preg_replace('/\s*(<[^>]+>)\s*/', '$1', $html);

        // Restore some necessary spaces
        $html = str_replace('< ', '<', $html);
        $html = str_replace(' >', '>', $html);

        return $html;
    }
}
