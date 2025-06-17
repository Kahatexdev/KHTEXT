<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_cekqty_rosset extends Model
{
    use HasFactory;

    protected $table = 'tb_cekqty_rosset';
    protected $fillable = [
        'tanggal_input',
        'ttl_mc',
        'jl_mc',
        'area',
        'bagian',
        'qty_erp_rosset',
        'qty_mis_rosset',
        'qty_reject',
        'qty_rework',
        'direct',
        'ket_erp_rosset',
        'ket_mis_rosset',
        'ket_overshift_siang_kepagi',
        'ket_overshift_pagi_kesiang',
        'ket_reject',
        'ket_rework',
        'shift',
        'id_user'
    ];
    protected $primaryKey = 'id_cekqty_rosset ';
    public $timestamps = true;
    
}
