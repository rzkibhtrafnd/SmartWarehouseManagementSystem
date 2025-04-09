<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeder
        $this->call([
            UserSeeder::class,
            GudangSeeder::class,
            KategoriSeeder::class,
            ProdukSeeder::class,
            TransaksiSeeder::class,
        ]);
    }
}
