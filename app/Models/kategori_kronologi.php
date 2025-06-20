<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_kronologi extends Model
{
    use HasFactory;

    protected $table = 'kategori_kronologi';
    protected $primaryKey = 'id_kategori';
    public $timestamps = true;

    protected $fillable = [
        'nama_kategori',
    ];

    public function getRouteKeyName()
    {
        return 'id_kategori';
    }
}
