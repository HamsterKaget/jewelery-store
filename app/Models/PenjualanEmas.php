<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanEmas extends Model
{
    use HasFactory;

    protected $table = 'penjualan_emas';

    protected $fillable = [
        'emas_id',
        'toko_id',
        'karyawan_id',
        'pelanggan_id',
        'no_transaksi',
        'tanggal_pembelian',
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'metode_pembayaran',
        'bank',
        'jenis_kartu',
    ];

    public function Emas() {
        return $this->belongsTo(Emas::class, 'emas_id', 'emas');
    }

    public function Karyawan() {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }

    public function Pelanggan() {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }
}
