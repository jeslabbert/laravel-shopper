<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category;
        $category->name = "Laptops";
        $category->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo lacus eget lectus ultricies suscipit. Donec ut ligula sed augue tincidunt fermentum. Nulla mollis gravida nulla quis rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus.';
        $category->image = 'https://images-na.ssl-images-amazon.com/images/I/81oVSSITRQL._AC_SL1500_.jpg';
        $category->save();

        $items = [
            [
                'name' => "HP Envy 13 Laptop",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo lacus eget lectus ultricies suscipit. Donec ut ligula sed augue tincidunt fermentum. Nulla mollis gravida nulla quis rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/71KnfK-KuuL._AC_SL1500_.jpg',
                'price' => 988.90,
                'category_id' => $category->id,
                'quantity' => 10
            ],
            [
                'name' => "ASUS VivoBook 15 F515 Thin and Light Laptop",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo lacus eget lectus ultricies suscipit. Donec ut ligula sed augue tincidunt fermentum. Nulla mollis gravida nulla quis rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/81oVSSITRQL._AC_SL1500_.jpg',
                'price' => 399.99,
                'category_id' => $category->id,
                'quantity' => 10
            ],
            [
                'name' => "Acer Predator Triton 500 PT515-52-71K5 Gaming Laptop",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo lacus eget lectus ultricies suscipit. Donec ut ligula sed augue tincidunt fermentum. Nulla mollis gravida nulla quis rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/71cMeRQvONL._AC_SL1500_.jpg',
                'price' => 1699.99,
                'category_id' => $category->id,
                'quantity' => 10
            ],
            [
                'name' => "Latitude 7420 21 I7/3.0 16GB 256GB W10P",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo lacus eget lectus ultricies suscipit. Donec ut ligula sed augue tincidunt fermentum. Nulla mollis gravida nulla quis rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/419dFB6OGgL._AC_.jpg',
                'price' => 1795.00,
                'category_id' => $category->id,
                'quantity' => 10
            ]
        ];

        DB::table('products')->insert($items);
    }
}
