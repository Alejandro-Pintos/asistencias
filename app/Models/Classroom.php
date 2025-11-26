<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'teacher_id',
        'shift',
    ];

    // Profesor a cargo de la clase
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Alumnos inscriptos en la clase
    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_user')
            ->withTimestamps();
    }
}
