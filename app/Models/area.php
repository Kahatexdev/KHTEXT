<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;

    protected $table = 'area';
    protected $fillable = [
        'nama_area',
    ];
    // Primary key-nya adalah nama_area
    protected $primaryKey = 'nama_area';
    // Tipe key-nya string
    protected $keyType = 'string';

    // Non‐incrementing karena bukan integer auto‐increment
    public $incrementing = false;

    // Kalau tidak pakai timestamps
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'nama_area';
    }
}
