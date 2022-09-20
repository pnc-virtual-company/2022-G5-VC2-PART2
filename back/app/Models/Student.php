<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class,'id');
    }

    public function classbatch() {
        return $this->belongsTo(ClassBatch::class);
    }

    public function batch() {
        return $this->belongsTo(Batch::class);
    }

    public function followup() {
        return $this->belongsTo(FollowUp::class,'id');
    }

    public function  comment() {
        return $this->hasMany(Comment::class,'id');
    }
}