<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['kode_pesanan', 'id_pelanggan', 'status_pesanan', 'tanggal_pesanan', 'alamat_pengiriman', 'harga_ongkir', 'ekspedisi', 'total_biaya'];
}
