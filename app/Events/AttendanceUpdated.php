<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttendanceUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public int $classroomId;
    public string $date;

    public function __construct(int $classroomId, string $date)
    {
        $this->classroomId = $classroomId;
        $this->date = $date;
    }

    // Canal público: classroom.{id}
    public function broadcastOn(): array
    {
        return [new Channel('classroom.' . $this->classroomId)];
    }

    // Nombre del evento que ve el frontend
    public function broadcastAs(): string
    {
        return 'AttendanceUpdated';
    }

    // Opcional: data extra que quieras mandar
    public function broadcastWith(): array
    {
        return [
            'classroomId' => $this->classroomId,
            'date'        => $this->date,
        ];
    }
}
