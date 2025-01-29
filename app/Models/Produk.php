<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = ['nama', 'kategori_id', 'gudang_id', 'stok', 'harga', 'deskripsi'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
