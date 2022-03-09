<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;
    
    protected $table = 'umkm';

    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['id_bumdes', 'nama', 'username', 'password', 'alamat', 'telp', 'foto'];
}
