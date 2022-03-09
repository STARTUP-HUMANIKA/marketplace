<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bumdes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['nama', 'email', 'password', 'alamat', 'telp', 'foto'];
}
