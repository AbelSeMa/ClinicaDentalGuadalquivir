<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'price', 'duration_in_months', 'active' ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function pacientes()
    {
        return $this->hasMany(Patient::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
