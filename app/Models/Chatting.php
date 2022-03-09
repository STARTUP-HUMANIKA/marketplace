<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    use HasFactory;

    protected $table = 'chatting';

    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['pesan_dari', 'pesan_ke', 'isi_pesan'];
}
