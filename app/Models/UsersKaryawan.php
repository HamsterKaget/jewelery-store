<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersKaryawan extends Model
{
    use HasFactory;

    protected $table = 'users_karyawan';

    protected $fillable = [
        'user_id',
        'karyawan_id'
    ];

    public function User() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
