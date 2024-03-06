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

    public function Toko() {
        return $this->belongsTo(Toko::class, 'toko_id', 'id');
    }

}
