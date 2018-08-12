<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Store::class, 10)->create()->each(function ($store) {
            $this->createCustomerRows($store);

            $categories = factory(App\Models\ProductCategory::class, rand(1, 5))->create([
               'store_id' => $store->id
            ]);

            $domains = factory(App\Models\StoreDomain::class, rand(1, 3))->create([
                'store_id' => $store->id
            ]);

            $domains->each(function ($domain) use ($store, $categories) {
                $locations = factory(App\Models\StoreLocation::class)->create([
                    'store_id' => $store->id,
                    'store_domain_id' => $domain->id
                ]);

                $locations->each(function ($location) use ($store, $categories) {

                    $categories->each(function ($category) use ($store, $location) {
                        factory(App\Models\Product::class, rand(1, 100))->create([
                            'store_id' => $store->id,
                            'store_location_id' => $location->id,
                            'category_id' => $category->id,
                        ])->each(function ($product) {
                            $product->update([
                                'sku' => '00000' . rand(0, 999)
                            ]);
                        });
                    });
                });
            });
        });
    }

    protected function createCustomerRows($store)
    {
        factory(App\Models\Customer::class, rand(10, 50))->create([
            'store_id' => $store->id
        ]);
    }
}
