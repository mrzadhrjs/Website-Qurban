<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    use HasFactory;

    protected $table = 'bobot';
    protected $guarded = [];

    public function relationToHewan(){
        return $this->belongsToMany(Hewan::class, 'hewanbobot');
    }

    public function relationToGrade(){
        return $this->belongsToMany(Grade::class, 'gradebobot');
    }
}
