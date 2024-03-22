<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'created_by',
    ];

    public function CreatedBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
