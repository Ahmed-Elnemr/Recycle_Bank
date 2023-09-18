<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PayOutRequestSeeder extends Seeder
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
            DB::table('pay_out_requests')->insert([


                'user_id'=> $faker->numberBetween(1, 100) ,
                'amount'=>$faker->numberBetween(200, 500) ,
                'reason'=>$faker->sentence(5),
                'pay_out_methods_id'=> $faker->numberBetween(1, 100),

            ]);
        }
    }
}
