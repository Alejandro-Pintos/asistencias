<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Events\AttendanceUpdated;

class ClassroomAttendanceController extends Controller
{
    // Mostrar formulario de asistencia
    public function edit(Request $request, Classroom $classroom)
    {
        // Seguridad extra: que la clase sea del profe logueado
        if ($classroom->teacher_id !== auth()->id()) {
            abort(403);
        }

        $date = $request->input('date', now()->toDateString());

        $students = $classroom->students()->orderBy('name')->get();

        $attendances = Attendance::where('classroom_id', $classroom->id)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id'); // [student_id => Attendance]

        return view('profesor.attendance', [
            'classroom'   => $classroom,
            'students'    => $students,
            'date'        => $date,
            'attendances' => $attendances,
        ]);
    }

    // Guardar/actualizar la asistencia
    public function update(Request $request, Classroom $classroom)
    {
        if ($classroom->teacher_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'date'     => ['required', 'date'],
            'status'   => ['required', 'array'],
            'status.*' => ['required', 'in:present,absent,late,justified'],
        ]);

        // 1) Obtenemos los alumnos de la clase
        $students = $classroom->students()->orderBy('name')->get();

        // 2) Guardamos/actualizamos la asistencia alumno por alumno
        foreach ($students as $student) {
            // Si por alguna razón no vino status para este alumno, lo salteamos
            if (! isset($data['status'][$student->id])) {
                continue;
            }

            Attendance::updateOrCreate(
                [
                    'classroom_id' => $classroom->id,
                    'student_id'   => $student->id,
                    'date'         => $data['date'],
                ],
                [
                    'taken_by' => auth()->id(),
                    'status'   => $data['status'][$student->id],
                ]
            );
        }

        // 3) Disparamos evento de broadcast para los alumnos
        \Log::info('[BACKEND] Disparando evento AttendanceUpdated', [
            'classroom_id' => $classroom->id,
            'date' => $data['date'],
        ]);
        
        broadcast(new AttendanceUpdated(
            $classroom->id,
            $data['date']
        ))->toOthers();
        
        \Log::info('[BACKEND] Evento broadcast ejecutado');

        // 4) Volvemos al formulario con mensaje
        return redirect()
            ->route('profesor.classrooms.attendance.edit', [
                'classroom' => $classroom->id,
                'date'      => $data['date'],
            ])
            ->with('status', 'Asistencia guardada correctamente.');
    }
}
