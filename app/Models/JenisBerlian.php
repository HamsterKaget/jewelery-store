<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBerlian extends Model
{
    use HasFactory;

    protected $table = 'jenis_berlian';

    protected $fillable = [
        'nama',
        'created_by',
    ];

    public function CreatedBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
