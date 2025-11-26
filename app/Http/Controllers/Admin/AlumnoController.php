<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = User::where('role', 'student')
            ->with('classrooms')
            ->orderBy('name')
            ->get();
        
        return view('admin.alumnos.index', compact('alumnos'));
    }
}
