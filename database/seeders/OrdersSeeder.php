<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OrdersSeeder extends Seeder
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
            DB::table('orders')->insert([
                'user_id' => $faker->numberBetween(1, 100) ,
                'delivery_id' => $faker->numberBetween(1, 100) ,
                'note' => $faker->sentence(10),
                'total' => $faker->randomFloat(2),
                'address_id' => $faker->numberBetween(1, 100) ,
                'status' => $faker->sentence(5),

            ]);
        }
    }
}
