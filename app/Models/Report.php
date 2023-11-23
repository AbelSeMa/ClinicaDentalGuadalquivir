<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'content' ];
    
    public function trabajador() {
        return $this->belongsTo(Worker::class);
    }

    public function paciente() {
        return $this->belongsTo(Patient::class);
    }

    public function cita() {
        return $this->belongsTo(Appointment::class);
    }
}
