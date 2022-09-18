<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassBatch extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function batch() {
        return $this->belongsTo(Batch::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }
}
