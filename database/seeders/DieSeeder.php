<?php

namespace Database\Seeders;

use App\Models\Death;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class DieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');
        $model = new Death;
        $model->truncate();

        for ($i=0; $i < 10; $i++) {
            $model->create([
                'resident_id' => $faker->randomDigitNot(0),
                'NIK' => $faker->nik,
                'resident' => $faker->name,
                'gender' => $faker->name,
                'resident' => $faker->name,
                'resident' => $faker->name,
                'date' => $faker->date,
                'place' => $faker->city,
                'penyebab' => $faker->text,
            ]);
        }
    }
}
