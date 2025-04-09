<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GudangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            DB::table('gudang')->insert([
                'nama' => 'Gudang ' . $faker->unique()->citySuffix,
                'lokasi' => $faker->city,
                'kapasitas' => $faker->numberBetween(500, 5000),
                'status' => $faker->randomElement(['aktif', 'tidak aktif']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
