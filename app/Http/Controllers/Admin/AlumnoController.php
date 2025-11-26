<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classroom;
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

    public function edit(User $alumno)
    {
        if ($alumno->role !== 'student') {
            abort(404);
        }

        $classrooms = Classroom::orderBy('name')->get();
        $alumnoClassrooms = $alumno->classrooms->pluck('id')->toArray();

        return view('admin.alumnos.edit', compact('alumno', 'classrooms', 'alumnoClassrooms'));
    }

    public function update(Request $request, User $alumno)
    {
        if ($alumno->role !== 'student') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $alumno->id],
            'classrooms' => ['nullable', 'array'],
            'classrooms.*' => ['exists:classrooms,id'],
        ]);

        $alumno->name = $validated['name'];
        $alumno->email = $validated['email'];
        $alumno->save();

        // Sincronizar las clases del alumno
        $alumno->classrooms()->sync($validated['classrooms'] ?? []);

        return redirect()
            ->route('admin.alumnos.index')
            ->with('status', 'Alumno actualizado correctamente.');
    }
}
