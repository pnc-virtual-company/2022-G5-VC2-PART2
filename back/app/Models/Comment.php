<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $hidden = [
        'password',
        'code',
        'remember_token',
        'email_verified_at',
    ];
    
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function student() {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function replyComment() {
        return $this->belongsTo(ReplyComment::class,'id');
    }
}
