<?php

namespace Database\Seeders;

use App\Models\Job;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');
        $model = new Job();
        $model->truncate();
        
        for ($i=0; $i < 10; $i++) {
            $model->create([
                'name' => $faker->jobTitle,
            ]);
        }
    }
}
