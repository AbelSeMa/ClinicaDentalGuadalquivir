<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [ 'patient_id', 
                            'worker_id', 
                            'date',  
                            'notes', 
                            'attended' ];

    public function paciente() 
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function trabajador() 
    {
        return $this->belongsTo('App\Models\Worker');
    }
    
    // Relación 1:1

    public function informe()
    {
        return $this->hasOne('App\Models\Report');
    }
}
