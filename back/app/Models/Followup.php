<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;

    protected $hidden = [
        'remember_token',
        'email_verified_at',
        'remember_token',
        'password',
    ];

    protected $casts = [
        'type' => 'array'
    ];

    public function students() {
        return $this->hasMany(Student::class,'student_id');
    }

    public function totor() {
        return $this->belongsTo(User::class,'user_id');
    }
}