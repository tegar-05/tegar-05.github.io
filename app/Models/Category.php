<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = \Illuminate\Support\Str::slug($model->name);
        });
    }

    /**
     * Relasi ke produk
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relasi ke menus
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
