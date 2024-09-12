<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_has_user_siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_induk',
        'is_status_aktif',
        'created_at',
        'updated_at',
    ];
}
