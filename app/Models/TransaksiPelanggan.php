<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiPelanggan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transaksi_pelanggan';

    protected $fillable = [
        'id_transaksi'
    ];
}
