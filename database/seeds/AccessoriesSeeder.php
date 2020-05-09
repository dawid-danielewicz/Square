<?php

use Illuminate\Database\Seeder;

class AccessoriesSeeder extends Seeder
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
            DB::table('accessories')->insert([
                'name' => $faker->word,
                'quantity' => $faker->numberBetween(6, 20),
                'netto_price' => $faker->numberBetween(1, 10),
                'brutto_price' => $faker->numberBetween(1, 16),
                'price_per_piece' => $faker->numberBetween(1, 5),
                'in_store' => $faker->numberBetween(1, 100),
                'wholesale_id' => $faker->numberBetween(1, 5)
            ]);
        }
    }
}
