<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'email',
        'no_hp',
        'alamat',
    ];

    // Define the relationship with the User model via the users_karyawan pivot table
    public function UserKaryawan()
    {
        return $this->hasMany(UsersKaryawan::class, 'karyawan_id', 'id');
    }

    // Define the relationship with the Toko model via the karyawan_toko pivot table
    public function Toko()
    {
        return $this->belongsToMany(Toko::class, 'karyawan_toko', 'karyawan_id', 'toko_id');
    }
}
