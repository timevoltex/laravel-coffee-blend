<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Drinks
            [
                'id' => 3,
                'name' => 'Espresso',
                'image' => 'menu-2.jpg',
                'price' => 4.50,
                'type' => 'drinks',
                'description' => 'A rich and bold shot of pure coffee perfection. Made with premium Arabica beans, our espresso delivers an intense flavor with a smooth crema finish.',
            ],
            [
                'id' => 4,
                'name' => 'Latte',
                'image' => 'menu-3.jpg',
                'price' => 5.75,
                'type' => 'drinks',
                'description' => 'Creamy steamed milk perfectly blended with espresso. A classic favorite topped with delicate foam art that tastes as good as it looks.',
            ],
            [
                'id' => 5,
                'name' => 'Americano',
                'image' => 'menu-4.jpg',
                'price' => 4.25,
                'type' => 'drinks',
                'description' => 'Bold espresso diluted with hot water for a smooth, full-bodied coffee experience. Perfect for those who love strong coffee flavor.',
            ],
            [
                'id' => 6,
                'name' => 'Caramel Macchiato',
                'image' => 'drink-1.jpg',
                'price' => 6.50,
                'type' => 'drinks',
                'description' => 'Vanilla-flavored steamed milk layered with rich espresso and topped with buttery caramel drizzle. A sweet indulgence in every sip.',
            ],
            [
                'id' => 7,
                'name' => 'Cold Brew',
                'image' => 'drink-2.jpg',
                'price' => 5.25,
                'type' => 'drinks',
                'description' => 'Smooth, refreshing coffee steeped for 24 hours. Less acidic than traditional iced coffee with a naturally sweet and smooth taste.',
            ],
            [
                'id' => 8,
                'name' => 'Flat White',
                'image' => 'drink-3.jpg',
                'price' => 5.50,
                'type' => 'drinks',
                'description' => 'Velvety microfoam milk poured over a double shot of espresso. An Australian favorite with a perfect balance of coffee and milk.',
            ],
            // Desserts
            [
                'id' => 9,
                'name' => 'Chocolate Brownie',
                'image' => 'dessert-1.jpg',
                'price' => 4.75,
                'type' => 'desserts',
                'description' => 'Rich, fudgy chocolate brownie made with premium cocoa. Perfectly moist and decadent, served warm with a dusting of powdered sugar.',
            ],
            [
                'id' => 10,
                'name' => 'Tiramisu',
                'image' => 'dessert-3.jpg',
                'price' => 6.25,
                'type' => 'desserts',
                'description' => 'Classic Italian dessert with espresso-soaked ladyfingers layered with mascarpone cream. Finished with cocoa powder for the perfect coffee-flavored treat.',
            ],
            [
                'id' => 11,
                'name' => 'Cheesecake',
                'image' => 'dessert-4.jpg',
                'price' => 5.50,
                'type' => 'desserts',
                'description' => 'Creamy New York-style cheesecake with a graham cracker crust. Smooth, rich, and topped with fresh berry compote.',
            ],
            [
                'id' => 12,
                'name' => 'Croissant',
                'image' => 'dessert-5.jpg',
                'price' => 3.75,
                'type' => 'desserts',
                'description' => 'Buttery, flaky French pastry baked fresh daily. Golden and crispy on the outside, soft and layered on the inside. Perfect with your morning coffee.',
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product\Product::create($product);
        }
    }
}
