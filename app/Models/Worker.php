<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id','title', 'specialty' ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
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
