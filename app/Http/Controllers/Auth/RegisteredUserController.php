<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Classroom;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
public function create(): View
{
    $classrooms = Classroom::orderBy('name')->get();

    return view('auth.register', [
        'classrooms' => $classrooms,
    ]);
}

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            //NUEVO CAMPO:
            'classrooms' => ['nullable', 'array'],
            'classrooms.*' => ['integer', 'exists:classrooms,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);
        if ($request->filled('classrooms')) {
    $user->classrooms()->attach($request->input('classrooms'));
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
