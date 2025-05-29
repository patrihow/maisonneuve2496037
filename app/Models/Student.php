<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
    'name',
    'email',
    'birthdate', 
    'city_id',
    'password',
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
