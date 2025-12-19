<?php

namespace App\Helpers;

use Intervention\Image\Laravel\Facades\Image;

class ImageHelper
{
    /**
     * Compress and optimize uploaded image
     */
    public static function compressImage($file, $path, $filename, $quality = 80)
    {
        // Create directory if not exists
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Compress image using Intervention Image
        $image = Image::make($file);

        // Resize if too large (max 1920px width)
        if ($image->width() > 1920) {
            $image->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Save compressed image
        $image->save($path, $quality);

        return $path;
    }

    /**
     * Optimize and store uploaded image
     */
    public static function optimizeAndStore($file, $directory)
    {
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Define path
        $path = public_path('storage/' . $directory);
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $fullPath = $path . '/' . $filename;

        // Move the file to public/storage
        $file->move($path, $filename);

        // Compress and optimize the image
        self::compressImage($file, $fullPath, $filename);

        return $directory . '/' . $filename;
    }

    /**
     * Generate responsive image sizes
     */
    public static function generateResponsiveImages($originalPath, $filename)
    {
        $sizes = [
            'thumb' => 300,
            'medium' => 768,
            'large' => 1200,
        ];

        $paths = [];

        foreach ($sizes as $size => $width) {
            $path = str_replace($filename, $size . '_' . $filename, $originalPath);
            $image = Image::make($originalPath);
            $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save($path, 80);
            $paths[$size] = $path;
        }

        return $paths;
    }

    /**
     * Get optimized image URL with lazy loading attributes
     */
    public static function getOptimizedImage($path, $alt = '', $class = '', $width = null, $height = null)
    {
        $attributes = [
            'src' => asset('storage/' . $path),
            'alt' => $alt,
            'loading' => 'lazy',
        ];

        if ($class) {
            $attributes['class'] = $class;
        }

        if ($width) {
            $attributes['width'] = $width;
        }

        if ($height) {
            $attributes['height'] = $height;
        }

        // Generate srcset for responsive images
        $filename = basename($path);
        $directory = dirname($path);

        $srcset = [];
        if (file_exists(storage_path('app/public/' . $directory . '/thumb_' . $filename))) {
            $srcset[] = asset('storage/' . $directory . '/thumb_' . $filename) . ' 300w';
        }
        if (file_exists(storage_path('app/public/' . $directory . '/medium_' . $filename))) {
            $srcset[] = asset('storage/' . $directory . '/medium_' . $filename) . ' 768w';
        }
        if (file_exists(storage_path('app/public/' . $directory . '/large_' . $filename))) {
            $srcset[] = asset('storage/' . $directory . '/large_' . $filename) . ' 1200w';
        }

        if (!empty($srcset)) {
            $attributes['srcset'] = implode(', ', $srcset);
            $attributes['sizes'] = '(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw';
        }

        $attrString = '';
        foreach ($attributes as $key => $value) {
            $attrString .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
        }

        return '<img' . $attrString . '>';
    }
}
