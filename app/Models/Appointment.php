<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'worker_id',
        'date',
        'notes',
        'attended'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function worker()
    {
        return $this->belongsTo('App\Models\Worker');
    }

    public function report()
    {
        return $this->hasOne('App\Models\Report');
    }
}
