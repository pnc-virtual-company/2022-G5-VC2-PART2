<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;

     /**
    * get the tutor that own of the follow up.
    */
    public function users()
    {
        return $this->hasMany(User::class,'id');
    }

    /**
    * get the student that own of the follow up.
    */
    public function students()
    {
        return $this->hasMany(Student::class,'student_id');
    }
}
