<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalInformationSeeder extends Seeder
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
            DB::table('personal_information')->insert([
                'user_id'=>$faker->numberBetween(1,100),
                'first_name' => $faker->name(),
                'last_name' => $faker->name(),
                'personal_id' => '00245003',
                'idendety_type' => ' ',
                'gender' => 'male',
                'birthdate' => $faker->date(),
                'phone_number' => $faker->phoneNumber(),
                'nationality' => 'egypt',

            ]);
        }
    }
}
