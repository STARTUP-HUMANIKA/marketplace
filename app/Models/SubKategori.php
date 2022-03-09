<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';

    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['id_kategori', 'nama_sub_kategori'];
}
