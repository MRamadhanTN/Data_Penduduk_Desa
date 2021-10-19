<?php

namespace Database\Seeders;

use App\Models\Birth;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class BirthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');
        $model = new Birth;
        $model->truncate();
        
        for ($i=0; $i < 10; $i++) {
            $model->create([
                'resident_id' => $faker->randomDigitNot(0),
                'name' => $faker->name,
                'father' => $faker->name,
                'mother' => $faker->name,
                'weight' => $faker->randomDigitNot(0),
                'width' => $faker->randomDigitNot(0),
            ]);
        }
    }
}
