<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProductCategory::class, 5)->create();

        factory(App\Models\Product::class, 50)->create();
    }
}
