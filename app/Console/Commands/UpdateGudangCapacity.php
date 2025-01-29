<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Gudang;
use App\Models\Produk;

class UpdateGudangCapacity extends Command
{
    protected $signature = 'gudang:update-capacity';
    protected $description = 'Update kapasitas gudang berdasarkan produk yang ada';

    public function handle()
    {
        $gudangs = Gudang::all();
        foreach ($gudangs as $gudang) {
            $totalStokDiGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');
            $gudang->kapasitas -= $totalStokDiGudang;
            $gudang->save();
        }
        $this->info('Kapasitas gudang telah diperbarui.');
    }
}
