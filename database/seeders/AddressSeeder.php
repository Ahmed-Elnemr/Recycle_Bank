<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AddressSeeder extends Seeder
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
            DB::table('address')->insert([


                'city'=>$faker->sentence(5),
                'country'=>$faker->sentence(5),
                'street'=>$faker->sentence(5),
                'postal_code'=>$faker->randomNumber(5, true),
                'user_id'=>$faker->numberBetween(1, 100) ,
            ]);
        }
    }
}
