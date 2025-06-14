<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    public $timestamps = true;

    protected $fillable = [
        'judul_pengumuman',
        'isi_pengumuman',
        'gambar',
        'file_attachment',
    ];

    public function getRouteKeyName()
    {
        return 'id_pengumuman';
    }
}
