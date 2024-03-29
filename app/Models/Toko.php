<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Toko extends Model
{
    use HasFactory;

    protected $table = "toko";

    protected $fillable = [
        "nama_toko",
        "alamat",
        "npwp",
    ];

    public function Karyawan() {
        return $this->hasMany(KaryawanToko::class, 'toko_id', 'id');
    }
}

