<?php

namespace Database\Seeders;

use App\Models\FamilyDetail;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class FamilyDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     $faker = FakerFactory::create('id_ID');
    //     $model = new FamilyDetail;
    //     $model->truncate();

    //     for ($i=0; $i < 10; $i++) {
    //         $model->create([
    //             'family_id' => $faker->randomDigitNot(0),
    //             'no_kk' => $faker->nik,
    //             'kepala_keluarga' => $faker->name,
    //             'resident_id' => $faker->randomDigitNot(0),
    //             'resident' => $faker->name,
    //         ]);
    //     }
    // }
}
