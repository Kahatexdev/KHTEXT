<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_pdk extends Model
{
    use HasFactory;

    protected $table = 'tb_pdk';
    protected $primaryKey = 'id_pdk';
    public $timestamps = true;
    protected $fillable = [
        'id_pdk',
        'mastermodel',
        'factory',
        'size',
        'inisial',
        'created_at',
        'updated_at',
    ];
}
