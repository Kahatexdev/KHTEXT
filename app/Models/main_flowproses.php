<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_flowproses extends Model
{
    use HasFactory;

    protected $table = 'main_flowproses';
    protected $primaryKey = 'id_main_flow';
    public $timestamps = true;
    protected $fillable = [
        'idapsperstyle',
        'ket_flow',
        'tanggal',
        'ket',
        'area',
        'id_user',
    ];

    public function getRouteKeyName()
    {
        return 'id_main_flow';
    }
    public function flowProses()
    {
        return $this->hasMany(flow_proses::class, 'id_main_flow', 'id_main_flow');
    }
    public function kategoriKronologi()
    {
        return $this->belongsTo(kategori_kronologi::class, 'id_kategori', 'id_kategori');
    }
    public function area()
    {
        return $this->belongsTo(area::class, 'id_area', 'nama_area');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function masterProses()
    {
        return $this->belongsToMany(master_proses::class, 'flow_proses', 'id_main_flow', 'id_master_proses');
    }
    public function flowProsesByStep($step)
    {
        return $this->flowProses()->where('step_order', $step)->first();
    }
    public function flowProsesByMasterProses($masterProsesId)
    {
        return $this->flowProses()->where('id_master_proses', $masterProsesId)->first();
    }
}

