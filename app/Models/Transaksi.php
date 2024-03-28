<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "transaksi";

    protected $fillable = [
        "no_transaksi",
        "toko_id",
        "karyawan_id",
        "waktu_pembelian",
        "total_harga",
        "penyesuaian_harga",
        "payment_id",
        "status",
    ];

    public function Payment() {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function Karyawan() {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }

    public function Toko() {
        return $this->belongsTo(Toko::class, 'toko_id','id');
    }
}
