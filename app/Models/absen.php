<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    use HasFactory;

    protected $table = 'absen';
    protected $primaryKey = 'id_absen';
    protected $fillable = [
        'id_user',
        'tanggal',
        'jam_masuk',
        'keterangan',
    ];

    public function getRouteKeyName()
    {
        return 'id_absen';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
