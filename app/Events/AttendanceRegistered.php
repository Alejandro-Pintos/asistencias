<?php

namespace App\Events;

use App\Models\Attendance;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttendanceRegistered implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Attendance $attendance)
    {
    }

    public function broadcastOn(): array
    {
        // Canal público "attendances"
        return [new Channel('attendances')];
    }

    public function broadcastAs(): string
    {
        // Nombre del evento que vamos a escuchar en JS
        return 'AttendanceRegistered';
    }
}
