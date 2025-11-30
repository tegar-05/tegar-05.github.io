<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // beberapa sample hard-coded supaya layoutnya rapi
        $samples = [
            ['name'=>'Beefy Bite','price'=>45.00,'image'=>'https://i.imgur.com/IxO9r8u.png','is_popular'=>true],
            ['name'=>'Mini Burger','price'=>23.00,'image'=>'https://i.imgur.com/OpWvS6V.png','is_popular'=>true],
            ['name'=>'Roll HotDog','price'=>50.00,'image'=>'https://i.imgur.com/6qTNhxY.png','is_popular'=>false],
            ['name'=>'Mega Chicken','price'=>38.00,'image'=>'https://i.imgur.com/w8Ek0Ji.png','is_popular'=>true],
            ['name'=>'Chicken Wings','price'=>25.00,'image'=>'https://i.imgur.com/gWYx8VD.png','is_popular'=>false],
            ['name'=>'Spicy Spaghetti','price'=>32.00,'image'=>'https://i.imgur.com/h30ZgFi.png','is_popular'=>false],
            ['name'=>'Pepperoni Pizza','price'=>62.50,'image'=>'https://i.imgur.com/AFzHqVJ.png','is_popular'=>true],
            ['name'=>'Chicken BBQ','price'=>48.00,'image'=>'https://i.imgur.com/AmkHH9Z.png','is_popular'=>false],
        ];

        foreach ($samples as $s) {
            Menu::create([
                'name' => $s['name'],
                'slug' => \Illuminate\Support\Str::slug($s['name']) . '-' . time() . rand(1,999),
                'description' => 'Delicious '.$s['name'].' made from premium ingredients.',
                'price' => $s['price'],
                'image' => $s['image'],
                'is_popular' => $s['is_popular'],
                'is_active' => true,
            ]);
        }

        // tambahan random
        Menu::factory()->count(8)->create();
    }
}
