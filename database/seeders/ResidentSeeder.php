<?php

namespace Database\Seeders;

use App\Models\Resident;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');
        $model = new Resident();
        $model->truncate();

        for ($i=0; $i < 10; $i++) {
            $model->create([
            'NIK' => $faker->nik,
            'name' => $faker->name,
            'place_birth' => $faker->city,
            'birth' => $faker->date,
            'job_id' => $faker->randomDigitNot(0),
            'job' => $faker->jobTitle,
            'address' => $faker->address,
            'RT' => $faker->randomDigitNot(0),
            'RW' => $faker->randomDigitNot(0),
            'provinces_id' => 11,
            'provinces' => $faker->city,
            'regencies_id' => 1101,
            'regencies' => $faker->city,
            'districts_id' => 1101010,
            'districts' => $faker->city,
            'villages_id' => 1101010001,
            'villages' => $faker->city,
            'villages' => $faker->city,
            'family_id' => $faker->randomDigitNot(0),
            ]);
        }
    }
}
