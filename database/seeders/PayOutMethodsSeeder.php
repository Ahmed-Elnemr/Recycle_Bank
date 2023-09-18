<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PayOutMethodsSeeder extends Seeder
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
            DB::table('pay_out_methods')->insert([
                'user_id'=> $faker->numberBetween(1, 100) ,
                'payment_method'=>$faker->sentence(5),
                'payment_type'=>$faker->sentence(5),
                'value'=>$faker->numberBetween(200, 500),


            ]);
        }
    }
}
