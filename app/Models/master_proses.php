<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_proses extends Model
{
    use HasFactory;

    protected $table = 'master_proses';
    protected $primaryKey = 'id_master_proses';

    protected $fillable = [
        'nama_proses'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getRouteKeyName()
    {
        return 'id_master_proses';
    }
    public function flowProses()
    {
        return $this->hasMany(flow_proses::class, 'id_master_proses', 'id_master_proses')->orderBy('step_order');
    }
    public function mainFlowProses()
    {
        return $this->belongsToMany(main_flowproses::class, 'flow_proses', 'id_master_proses', 'id_main_flow');
    }

}
