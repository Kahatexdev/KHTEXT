<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class flow_proses extends Model
{
    use HasFactory;

    protected $table = 'flow_proses';
    protected $primaryKey = 'id_flow_proses';
    public $timestamps = true;
    protected $fillable = [
        'id_main_flow',
        'id_master_proses',
        'step_order',
        'status',
        'keterangan',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function getRouteKeyName()
    {
        return 'id_flow_proses';
    }
    public function mainFlowProses()
    {
        return $this->belongsTo(main_flowproses::class, 'id_main_flow', 'id_main_flow');
    }
    public function masterProses()
    {
        return $this->belongsTo(master_proses::class, 'id_master_proses', 'id_master_proses');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function previousFlowProses()
    {
        return $this->hasOne(flow_proses::class, 'id_main_flow', 'id_main_flow')
            ->where('step_order', '<', $this->step_order)
            ->orderBy('step_order', 'desc');
    }
    public function nextFlowProses()
    {
        return $this->hasOne(flow_proses::class, 'id_main_flow', 'id_main_flow')
            ->where('step_order', '>', $this->step_order)
            ->orderBy('step_order', 'asc');
    }
}
