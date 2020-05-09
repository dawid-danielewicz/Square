<?php

use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
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
            DB::table('sales')->insert([
                'quantity' => $faker->numberBetween(6, 20),
                'sales_type' => $faker->randomElement(['App\Product', 'App\Accessory', 'App\Set']),
                'sales_id' => $faker->numberBetween(1, 50),
            ]);
        }
    }
}
