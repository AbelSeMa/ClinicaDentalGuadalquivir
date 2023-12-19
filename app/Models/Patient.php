<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [ 'medical_history', 'payment_date', 'expiration_date' ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }
    
    public function citas()
    {
        return $this->hasMany('\App\Models\Appointment');
    }

}
