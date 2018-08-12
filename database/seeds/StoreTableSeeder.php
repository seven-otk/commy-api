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
            $customers = $this->createCustomerRows($store);
            $categories = $this->createProductCategoriesRows($store);
            $domains = $this->createDomainsRows($store);

            $domains->each(function ($domain) use ($store, $categories) {

                $locations = factory(App\Models\StoreLocation::class)->create([
                    'store_id' => $store->id,
                    'store_domain_id' => $domain->id
                ]);

                $locations->each(function ($location) use ($store, $categories) {

                    $categories->each(function ($category) use ($store, $location) {

                        $products = factory(App\Models\Product::class, rand(1, 100))->create([
                            'store_id' => $store->id,
                            'store_location_id' => $location->id,
                            'category_id' => $category->id,
                        ]);

                        $products->each(function ($product) {
                            $product->update([
                                'sku' => '00000' . rand(0, 999)
                            ]);
                        });
                    });

                });
            });
        });
    }

    /**
     * Create the customer rows associated to the store.
     *
     * @param $store
     */
    protected function createCustomerRows($store)
    {
        factory(App\Models\Customer::class, rand(10, 50))->create([
            'store_id' => $store->id
        ]);
    }

    /**
     * Create the product rows associated with the store.
     *
     * TODO: Add in store locations?
     *
     * @param $store
     */
    protected function createProductCategoriesRows($store)
    {
        factory(App\Models\ProductCategory::class, rand(1, 5))->create([
            'store_id' => $store->id
        ]);
    }

    /**
     * Create the domains row associated to the store
     *
     * @param $store
     */
    protected function createDomainsRows($store)
    {
        factory(App\Models\ProductCategory::class, rand(1, 5))->create([
            'store_id' => $store->id
        ]);
    }
}
