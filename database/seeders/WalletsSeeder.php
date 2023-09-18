<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class WalletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
    foreach (range(1,100) as $index) {
        DB::table('wallets')->insert([
            'user_id' => $faker->numberBetween(1, 100),
            'balance' => $faker->randomNumber(5, true),

        ]);
    }
    }
}
