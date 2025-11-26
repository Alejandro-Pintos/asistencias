<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\ClassroomAttendanceController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Dashboard genérico: redirige según el rol del usuario
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('profesor.dashboard'),
        default   => redirect()->route('alumno.dashboard'), // student u otro
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil (las que ya tenías)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================
// RUTAS POR ROL
// =====================

// Panel ADMIN: crea profesores, configura clases, etc.
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Panel PROFESOR / PRECEPTOR: tomar asistencias
Route::middleware(['auth', 'verified', 'role:teacher'])->group(function () {
    Route::get('/profesor', function () {
        return view('profesor.dashboard');
    })->name('profesor.dashboard');

    // Rutas para tomar asistencias en las clases del profesor
    Route::get('/profesor/classrooms/{classroom}/attendance', [ClassroomAttendanceController::class, 'edit'])
        ->name('profesor.classrooms.attendance.edit');

            Route::post('/profesor/classrooms/{classroom}/attendance', [ClassroomAttendanceController::class, 'update'])
        ->name('profesor.classrooms.attendance.update');

});

// Panel ALUMNO: ver compañeros, estado de asistencias propias, etc.
Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::get('/alumno', function () {
        return view('alumno.dashboard');
    })->name('alumno.dashboard');
      // Nueva ruta: ver asistencias del alumno
    Route::get('/alumno/asistencias', [StudentAttendanceController::class, 'index'])
        ->name('alumno.attendances.index');
});

require __DIR__.'/auth.php';
