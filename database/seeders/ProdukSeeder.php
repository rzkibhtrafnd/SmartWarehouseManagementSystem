<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $i) {
            DB::table('produk')->insert([
                'nama' => ucfirst($faker->unique()->word) . ' ' . $faker->unique()->numerify('###'),
                'kategori_id' => $faker->numberBetween(1, 6), // 6 kategori
                'gudang_id' => $faker->numberBetween(1, 10), // 10 gudang
                'stok' => $faker->numberBetween(10, 1000),
                'harga' => $faker->randomFloat(2, 10000, 5000000),
                'deskripsi' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
