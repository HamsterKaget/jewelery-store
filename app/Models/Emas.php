<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'emas';

    protected $fillable = [
        'toko_id',
        'user_id',
        'kode',
        'nama_produk',
        'tanggal_dibuat',
        'tanggal_terjual',
        'berat',
        'tukeran',
        'kadar',
        'persentase',
        'harga_beli',
        'harga_jual',
        'sales',
        'keterangan',
        'status_stok',
        'EL_HAU',
        'thumbnail',
        'jenis_emas_id',
        'jenis_barang_id',
        'stok',
    ];

    public function Toko() {
        return $this->belongsTo(Toko::class, 'toko_id', 'id');
    }

    public function User() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function JenisEmas() {
        return $this->belongsTo(JenisEmas::class, 'jenis_emas_id', 'id');
    }

    public function JenisBarang() {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id', 'id');
    }
}
