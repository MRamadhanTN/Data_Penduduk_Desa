<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $model = new User();
        $model->truncate();
        
        for ($i=0; $i < 5; $i++) {
            $model->create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => Hash::make('123465678'),
            ]);
        }

    }
}
