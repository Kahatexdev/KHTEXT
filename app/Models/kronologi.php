<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kronologi extends Model
{
    use HasFactory;

    protected $table = 'kronologi_kesalahan';
    protected $fillable = [
        'tanggal',
        'wip',
        'area',
        'no_model_salah',
        'style_salah',
        'label_salah',
        'no_mc_salah',
        'krj_salah',
        'qty_salah',
        'no_model_benar',
        'style_benar',
        'label_benar',
        'no_mc_benar',
        'krj_benar',
        'qty_benar',
        'kategori',
        'keterangan',
        'keterangan_maintenance',
        'username',
    ];
}
