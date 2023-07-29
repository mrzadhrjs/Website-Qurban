<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'grade';
    protected $guarded = [];

    public function relationToHewan(){
        return $this->belongsToMany(Hewan::class, 'hewangrade');
    }

    public function relationToBobot(){
        return $this->belongsToMany(Bobot::class, 'gradebobot');
    }

}
