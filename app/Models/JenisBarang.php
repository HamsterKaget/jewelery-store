<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'jenis_barang';

    protected $fillable = [
        'nama',
        'created_by',
    ];

    public function CreatedBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
