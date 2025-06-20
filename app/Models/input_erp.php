<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class input_erp extends Model
{
    use HasFactory;

    protected $table = 'input_erp';
    protected $fillable = [
        'tanggal_input',
        'start_input',
        'stop_input',
        'area',
        'ttl_mc',
        'jln_mc',
        'prod_erp',
        'ket',
        'shift',
        'id_user'
    ];
    protected $primaryKey = 'id_input';
    public $timestamps = true;
}
