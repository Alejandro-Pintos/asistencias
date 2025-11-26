<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttendanceUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $classroomId;
    public string $date;

    public function __construct(int $classroomId, string $date)
    {
        $this->classroomId = $classroomId;
        $this->date = $date;
        
        \Log::info('[EVENT] AttendanceUpdated creado', [
            'classroom_id' => $classroomId,
            'date' => $date,
        ]);
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
