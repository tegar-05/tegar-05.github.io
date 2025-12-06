<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_popular',
        'is_active'
    ];

    protected static function booted()
    {
        static::creating(function ($item) {
            // Buat slug otomatis jika belum diisi
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->name) . '-' . time();
            }
        });
    }
}
