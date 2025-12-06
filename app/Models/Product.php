<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'sold',
        'image',
        'category_id', // ganti 'category' menjadi relasi
        'is_signature',
        'is_flores',
        'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'sold' => 'integer',
        'is_signature' => 'boolean',
        'is_flores' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke tabel categories
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Contoh accessor untuk badge warna di admin
     */
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status ?? 'pending') {
            'pending' => 'bg-yellow-300 text-yellow-800',
            'processing' => 'bg-blue-300 text-blue-800',
            'delivering' => 'bg-indigo-300 text-indigo-800',
            'completed' => 'bg-green-300 text-green-800',
            'cancelled' => 'bg-red-300 text-red-800',
            default => 'bg-gray-300 text-gray-800',
        };
    }
}
