<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Signature Coffees
            [
                'name' => 'Madame Djeli Signature Latte',
                'description' => 'Our signature espresso blend with caramel notes, silky crema, and premium milk foam.',
                'price' => 45000,
                'category' => 'Coffee',
                'image' => 'signature-latte.jpg',
                'is_signature' => true,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 245,
            ],
            [
                'name' => 'Rose Garden Cappuccino',
                'description' => 'Espresso with rose-infused foam and delicate floral notes.',
                'price' => 42000,
                'category' => 'Coffee',
                'image' => 'rose-cappuccino.jpg',
                'is_signature' => true,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 189,
            ],

            // Flores Products
            [
                'name' => 'Pink Rose Bouquet',
                'description' => 'Elegant arrangement of premium pink roses with seasonal greenery.',
                'price' => 150000,
                'category' => 'Flores',
                'image' => 'pink-rose-bouquet.jpg',
                'is_signature' => false,
                'is_flores' => true,
                'is_active' => true,
                'sold' => 67,
            ],
            [
                'name' => 'White Lily Collection',
                'description' => 'Pure white lilies arranged with baby\'s breath and eucalyptus.',
                'price' => 180000,
                'category' => 'Flores',
                'image' => 'white-lily-collection.jpg',
                'is_signature' => false,
                'is_flores' => true,
                'is_active' => true,
                'sold' => 43,
            ],

            // Regular Coffee
            [
                'name' => 'Americano',
                'description' => 'Classic espresso diluted with hot water for a bold, clean taste.',
                'price' => 35000,
                'category' => 'Coffee',
                'image' => 'americano.jpg',
                'is_signature' => false,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 312,
            ],
            [
                'name' => 'Cold Brew',
                'description' => 'Smooth, low-acidity coffee brewed cold for 24 hours.',
                'price' => 38000,
                'category' => 'Coffee',
                'image' => 'cold-brew.jpg',
                'is_signature' => false,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 198,
            ],

            // Non-Coffee Beverages
            [
                'name' => 'Matcha Latte',
                'description' => 'Premium Japanese matcha whisked with steamed milk.',
                'price' => 40000,
                'category' => 'Non-Coffee',
                'image' => 'matcha-latte.jpg',
                'is_signature' => false,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 156,
            ],
            [
                'name' => 'Chamomile Tea',
                'description' => 'Calming herbal tea with honey and lemon notes.',
                'price' => 32000,
                'category' => 'Non-Coffee',
                'image' => 'chamomile-tea.jpg',
                'is_signature' => false,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 134,
            ],

            // Desserts
            [
                'name' => 'Butter Croissant',
                'description' => 'Flaky, buttery French pastry baked fresh daily.',
                'price' => 25000,
                'category' => 'Dessert',
                'image' => 'butter-croissant.jpg',
                'is_signature' => false,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 287,
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert with coffee-soaked ladyfingers and mascarpone.',
                'price' => 55000,
                'category' => 'Dessert',
                'image' => 'tiramisu.jpg',
                'is_signature' => false,
                'is_flores' => false,
                'is_active' => true,
                'sold' => 98,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
