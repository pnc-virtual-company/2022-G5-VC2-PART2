<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function classes() {
        return $this->hasMany(ClassBatch::class,'batch_id');
    }

    public function students() {
        return $this->hasMany(Student::class,'batch_id','student_id');
    }

    // public function user() {
    //     return $this->hasMany(User::class);
    // }
}
