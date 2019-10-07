<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 10)->create()->each(function($product) {
            $product->categories()->attach(\App\Category::all()->random(mt_rand(1, 3))->pluck('id'));
        });
    }
}
