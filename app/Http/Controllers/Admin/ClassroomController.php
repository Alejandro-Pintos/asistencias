<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with('teacher')
            ->orderBy('name')
            ->get();
        
        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        $profesores = User::where('role', 'teacher')
            ->orderBy('name')
            ->get();
        
        return view('admin.classrooms.create', compact('profesores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'teacher_id' => ['required', 'exists:users,id'],
            'shift' => ['nullable', 'string', 'in:mañana,tarde,noche'],
        ]);

        $classroom = Classroom::create($validated);

        return redirect()
            ->route('admin.classrooms.index')
            ->with('status', 'Clase creada correctamente.');
    }

    public function edit(Classroom $classroom)
    {
        $profesores = User::where('role', 'teacher')
            ->orderBy('name')
            ->get();
        
        return view('admin.classrooms.edit', compact('classroom', 'profesores'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'teacher_id' => ['required', 'exists:users,id'],
            'shift' => ['nullable', 'string', 'in:mañana,tarde,noche'],
        ]);

        $classroom->update($validated);

        return redirect()
            ->route('admin.classrooms.index')
            ->with('status', 'Clase actualizada correctamente.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()
            ->route('admin.classrooms.index')
            ->with('status', 'Clase eliminada correctamente.');
    }
}
