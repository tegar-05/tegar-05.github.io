<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'payment_method',
        'order_items',
        'total',
        'status',
    ];

    protected $casts = [
        'order_items' => 'array',
        'total' => 'decimal:2',
        'status' => 'string',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor untuk badge color
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-300 text-yellow-800',
            'awaiting_payment' => 'bg-orange-300 text-orange-800',
            'pending_payment' => 'bg-blue-300 text-blue-800',
            'processing' => 'bg-indigo-300 text-indigo-800',
            'delivering' => 'bg-purple-300 text-purple-800',
            'paid' => 'bg-green-300 text-green-800',
            'completed' => 'bg-emerald-300 text-emerald-800',
            'cancelled' => 'bg-red-300 text-red-800',
            default => 'bg-gray-300 text-gray-800',
        };
    }
}
