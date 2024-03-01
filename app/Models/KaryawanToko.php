<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanToko extends Model
{
    use HasFactory;

    protected $table = 'karyawan_toko';

    protected $fillable = [
        'karyawan_id',
        'toko_id',
    ];

}
