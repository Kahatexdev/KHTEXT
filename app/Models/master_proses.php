<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_proses extends Model
{
    use HasFactory;

    protected $table = 'master_proses';
    protected $primaryKey = 'id_master_proses';

    protected $fillable = [
        'nama_proses'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
