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
            $tipe = $faker->randomElement(['masuk', 'keluar']);
            
            $transaksiData = [
                'produk_id' => $faker->numberBetween(1, 50),
                'kuantitas' => $faker->numberBetween(1, 100),
                'tipe' => $tipe,
                'user_id' => $faker->numberBetween(1, 3),
                'tanggal' => $faker->dateTimeBetween('-1 year', 'now'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($tipe === 'masuk' || $faker->boolean(30)) {
                $transaksiData['gudang_id'] = $faker->numberBetween(1, 10);
            }

            DB::table('transaksi')->insert($transaksiData);
        }
    }
}