<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'specialty' ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }


    public function citas()
    {
        return $this->hasMany(Appointment::class);
    }

    public function informes()
    {
        return $this->hasMany(Report::class);
    }
}
