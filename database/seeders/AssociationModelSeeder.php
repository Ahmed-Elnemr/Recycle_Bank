<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssociationModelSeeder extends Seeder
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
            DB::table('association_models')->insert([
                'user_id'=>$faker->numberBetween(1, 100) ,
                'value'=>$faker->numberBetween(50, 100) ,
                'approved_on'=>$faker->date(),
                'state'=>'approved',
                'user_order'=>$faker->numberBetween(1, 100) ,
                'claimed'=>' 2',
                'claimed_date'=>$faker->date(),
                'finished'=> '1',
                'finished_date'=>$faker->date(),
                'suspended'=> '1 ',
                // 'due_date'=>,
                'last_installment_date'=> '2020-01-01T00:00:00.000Z',
                'next_month'=>3,
            ]);
        }
    }
}
