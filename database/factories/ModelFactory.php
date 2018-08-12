<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Store::class, function (Faker\Generator $faker) {
   return [
       'name' => $faker->name,
       'short_description' => $faker->paragraph,
       'description' => $faker->sentences(3, true)
   ];
});

$factory->define(App\Models\StoreLocation::class, function (Faker\Generator $faker) {
    return [
        'address_line_1' => $faker->buildingNumber,
        'address_line_2' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'phone_number' => $faker->phoneNumber,
        'email_address' => $faker->companyEmail
    ];
});

$factory->define(App\Models\StoreDomain::class, function (Faker\Generator $faker) {
    return [
        'domain' => $faker->domainName
    ];
});

$factory->define(App\Models\Customer::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'password' => password_hash('password', PASSWORD_BCRYPT, [
            'cost' => 11
        ])
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 5),
        'title' => $faker->sentence,
        'short_description' => $faker->paragraph,
        'description' => $faker->sentences(3, true),
        'price' => $faker->randomFloat(2),
        'stock_count' => $faker->numberBetween(0, 100)
    ];
});

$factory->define(\App\Models\ProductCategory::class, function (Faker\Generator $faker) {
    $word = $faker->word;

   return [
       'title' => $word,
       'slug' => str_slug($word)
   ];
});