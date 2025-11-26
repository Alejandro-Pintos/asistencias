<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = User::where('role', 'teacher')
            ->orderBy('name')
            ->get();
        
        return view('admin.profesores.index', compact('profesores'));
    }

    public function create()
    {
        return view('admin.profesores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $profesor = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
        ]);

        return redirect()
            ->route('admin.profesores.index')
            ->with('status', 'Profesor creado correctamente.');
    }

    public function edit(User $profesor)
    {
        if ($profesor->role !== 'teacher') {
            abort(404);
        }
        
        return view('admin.profesores.edit', compact('profesor'));
    }

    public function update(Request $request, User $profesor)
    {
        if ($profesor->role !== 'teacher') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $profesor->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $profesor->name = $validated['name'];
        $profesor->email = $validated['email'];
        
        if ($request->filled('password')) {
            $profesor->password = Hash::make($validated['password']);
        }
        
        $profesor->save();

        return redirect()
            ->route('admin.profesores.index')
            ->with('status', 'Profesor actualizado correctamente.');
    }

    public function destroy(User $profesor)
    {
        if ($profesor->role !== 'teacher') {
            abort(404);
        }

        $profesor->delete();

        return redirect()
            ->route('admin.profesores.index')
            ->with('status', 'Profesor eliminado correctamente.');
    }
}
