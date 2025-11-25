<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Classroom;
use App\Models\Attendance;
class User extends Authenticatable
{
    // ...

    // Clases donde está inscripto (como alumno)
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_user')
            ->withTimestamps();
    }

    // Clases donde es profesor
    public function classroomsAsTeacher()
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }

    // Asistencias donde es alumno
    public function attendancesAsStudent()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    // Asistencias que él tomó (como profesor)
    public function attendancesTaken()
    {
        return $this->hasMany(Attendance::class, 'taken_by');
    }
}
