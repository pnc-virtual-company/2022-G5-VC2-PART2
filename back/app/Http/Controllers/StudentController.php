<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getLastStudent() {
        return Student::lastest()->first();
    }
}
