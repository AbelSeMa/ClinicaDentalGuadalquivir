<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'appointment_id', 'worker_id', 'content' ];
    
    public function worker() {
        return $this->belongsTo(Worker::class);
    }

    public function paciente() {
        return $this->belongsTo(Patient::class);
    }

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }
}
