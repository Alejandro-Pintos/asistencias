<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        $admin = User::updateOrCreate(
            ['email' => 'admin@asistencias.test'],
            [
                'name' => 'Administrador del Sistema',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // PROFESOR
        $teacher = User::updateOrCreate(
            ['email' => 'profesor@asistencias.test'],
            [
                'name' => 'Profesor Demo',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]
        );

        // Algunos alumnos de prueba
        $alumno1 = User::updateOrCreate(
            ['email' => 'alumno1@asistencias.test'],
            [
                'name' => 'Alumno Uno',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );

        $alumno2 = User::updateOrCreate(
            ['email' => 'alumno2@asistencias.test'],
            [
                'name' => 'Alumno Dos',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );

        // Clases del profesor
        $class1 = Classroom::updateOrCreate(
            ['name' => '3°A - Turno Mañana'],
            [
                'subject' => 'Matemática',
                'teacher_id' => $teacher->id,
            ]
        );

        $class2 = Classroom::updateOrCreate(
            ['name' => '1er Año - Tarde'],
            [
                'subject' => 'Programación',
                'teacher_id' => $teacher->id,
            ]
        );

        // Inscribir alumnos en clases
        $class1->students()->syncWithoutDetaching([$alumno1->id, $alumno2->id]);
        $class2->students()->syncWithoutDetaching([$alumno1->id]);
    }
}
