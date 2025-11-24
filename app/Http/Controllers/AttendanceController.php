<?php

namespace App\Http\Controllers;

use App\Events\AttendanceRegistered;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()->take(50)->get();

        return view('attendances.index', compact('attendances'));
    }

public function store(Request $request)
{
    $data = $request->validate([
        'person_name' => 'required|string|max:255',
    ]);

    $attendance = Attendance::create($data);

    // Avisamos por WebSocket a los demás
    broadcast(new AttendanceRegistered($attendance))->toOthers();

    // Volvemos a la pantalla principal
    return redirect()->route('attendances.index');
}
}