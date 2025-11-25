<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('classroom_id')
                ->constrained()
                ->cascadeOnDelete();

            // Alumno
            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Profesor que tomó la asistencia
            $table->foreignId('taken_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('date');

            $table->enum('status', ['present', 'absent', 'late', 'justified'])
                ->default('present');

            $table->timestamps();

            $table->unique(['classroom_id', 'student_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
