<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;
    protected $table = 'gudang';
    protected $fillable = ['nama', 'lokasi', 'kapasitas', 'status'];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
