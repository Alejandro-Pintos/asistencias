<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        $attendances = $student->attendancesAsStudent()
            ->with('classroom')
            ->orderByDesc('date')
            ->get();

        $summary = $attendances
            ->groupBy('status')
            ->map->count();

        // Obtener IDs de todas las clases en las que está inscripto (no solo las que tienen asistencia)
        $classroomIds = $student->classrooms()->pluck('classrooms.id');

        return view('alumno.attendances', [
            'student'     => $student,
            'attendances' => $attendances,
            'summary'     => $summary,
            'classroomIds' => $classroomIds,
        ]);
    }
}
