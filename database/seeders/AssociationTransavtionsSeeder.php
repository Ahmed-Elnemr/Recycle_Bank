<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssociationTransavtionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('association_transavtions')->insert([
                'association_models_id' => $faker->numberBetween(1, 100),
                'user_id' => $faker->numberBetween(1, 100),
                'value' => $faker->numberBetween(150, 1000),
                'currunt_month' => $faker->numberBetween(1,5),
                'next_month' => $faker->numberBetween(1,10),
                'wallet_id' => $faker->numberBetween(150, 1000),
                'wallet_transactions_id' => $faker->numberBetween(150, 1000),
            ]);
        }
    }
}
