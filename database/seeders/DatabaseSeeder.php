<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use App\Http\Livewire\Admin\Users;
use Database\Seeders\OrdersSeeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\WalletsSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\PayOutMethodsSeeder;
use Database\Seeders\PayOutRequestSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@ahmed.com',
            'role_id' => '1',
            'password' => Hash::make('ahmed')
        ]);
        $this->call([
            UsersSeeder::class,
            AddressSeeder::class,
            OrdersSeeder::class,
            WalletsSeeder::class,
            PayOutMethodsSeeder::class,
            PayOutRequestSeeder::class,
            PersonalInformationSeeder::class,
            AddressSeeder::class,
            AssociationModelSeeder::class,
            AssociationTransavtionsSeeder::class,
        ]);

    }
}
