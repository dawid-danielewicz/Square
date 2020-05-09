<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');
        for($i = 1; $i < 200; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'category' => $faker->numberBetween(1, 9),
                'color' => $faker->colorName,
                'pattern' => $faker->randomElement(['gładki', 'paski', 'kropki']),
                'quantity' => $faker->numberBetween(6, 20),
                'brutto_price' => $faker->numberBetween(1, 35),
                'netto_price' => $faker->numberBetween(1, 27),
                'price_per_piece' => $faker->numberBetween(1, 5),
                'in_store' => $faker->numberBetween(1, 100),
                'wholesale_id' => $faker->numberBetween(1, 5)
            ]);
        }
    }
}
