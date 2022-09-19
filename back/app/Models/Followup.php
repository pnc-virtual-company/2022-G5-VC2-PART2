<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;

    protected $hidden = [
        'remember_token',
        'updated_at',
        'email_verified_at',
        'remember_token',
        'password',
    ];
    public function students() {
        return $this->hasMany(Student::class,'id');
    }

    public function totor() {
        return $this->belongsTo(User::class,'user_id');
    }
}