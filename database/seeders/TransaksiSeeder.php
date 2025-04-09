<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $i) {
            DB::table('transaksi')->insert([
                'produk_id' => $faker->numberBetween(1, 50),     // asumsikan ada 50 produk
                'kuantitas' => $faker->numberBetween(1, 100),
                'tipe' => $faker->randomElement(['masuk', 'keluar']),
                'gudang_id' => $faker->numberBetween(1, 10),      // asumsikan ada 10 gudang
                'user_id' => $faker->numberBetween(1, 3),         // asumsikan ada 3 user
                'tanggal' => $faker->dateTimeBetween('-1 year', 'now'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
