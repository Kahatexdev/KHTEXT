<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_cekqty extends Model
{
    use HasFactory;

    protected $table = 'tb_cekqty';
    protected $fillable = [
        'tanggal_input',
        'area',
        'qty_erp',
        'qty_timter',
        'qty_summary',
        'qty_running',
        'qty_apk',
        'qty_reject',
        'qty_rework',
        'ket_reject',
        'ket_rework',
        'ket_erp',
        'ket_timter',
        'ket_summary',
        'ket_running',
        'ket_apk',
        'shift',
        'id_user'
    ];
    protected $primaryKey = 'id_cekqty';
    public $timestamps = true;
}
