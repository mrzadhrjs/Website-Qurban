<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;

    protected $table = 'hewan';
    protected $guarded = [];
    
    public function relationToBobot(){
        return $this -> belongsToMany(Bobot::class, 'hewanbobot');
    }

    public function relationToGrade(){
        return $this -> belongsToMany(Grade::class, 'hewangrade');
    }
}
