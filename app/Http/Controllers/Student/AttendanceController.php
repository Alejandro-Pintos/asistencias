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

        return view('alumno.attendances', [
            'student'     => $student,
            'attendances' => $attendances,
            'summary'     => $summary,
        ]);
    }
}
