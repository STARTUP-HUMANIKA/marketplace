<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['nama_pelanggan', 'email', 'password', 'alamat', 'telp', 'foto', 'tanggal_lahir', 'jenis_kelamin'];
}
