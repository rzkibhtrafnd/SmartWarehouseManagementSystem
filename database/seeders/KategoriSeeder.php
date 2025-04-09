<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Elektronik',
            'Pakaian',
            'Peralatan Rumah',
            'Makanan & Minuman',
            'Alat Tulis',
            'Otomotif',
        ];

        foreach ($kategori as $item) {
            DB::table('kategori')->insert([
                'nama' => $item,
                'deskripsi' => 'Kategori untuk ' . strtolower($item),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
