<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['id_umkm', 'id_sub_kategori', 'nama_produk', 'harga_produk', 'deskripsi'];
}
