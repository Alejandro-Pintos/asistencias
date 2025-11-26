<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tomar Asistencia - {{ $classroom->name }}
            </h2>
            <a href="{{ route('profesor.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">
                ← Volver a mis clases
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded">
                    <p class="font-medium">✓ {{ session('status') }}</p>
                </div>
            @endif

            <!-- Info de la clase -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Clase:</span>
                            <span class="font-semibold ml-2">{{ $classroom->name }}</span>
                        </div>
                        @if($classroom->subject)
                            <div>
                                <span class="text-gray-600">Materia:</span>
                                <span class="font-semibold ml-2">{{ $classroom->subject }}</span>
                            </div>
                        @endif
                        <div>
                            <span class="text-gray-600">Alumnos:</span>
                            <span class="font-semibold ml-2">{{ $students->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selector de fecha y formulario -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET"
                          action="{{ route('profesor.classrooms.attendance.edit', $classroom) }}"
                          class="mb-6 flex items-center gap-3">
                        <label for="date" class="text-sm font-medium text-gray-700">
                            Fecha:
                        </label>
                        <input
                            type="date"
                            id="date"
                            name="date"
                            value="{{ $date }}"
                            class="border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                        <x-primary-button type="submit">
                            Cambiar fecha
                        </x-primary-button>
                    </form>

                    <form method="POST"
                          action="{{ route('profesor.classrooms.attendance.update', $classroom) }}">
                        @csrf

                        <input type="hidden" name="date" value="{{ $date }}">

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Alumno
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="text-green-600">✓ Presente</span>
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="text-red-600">✗ Ausente</span>
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="text-yellow-600">⌚ Tarde</span>
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="text-blue-600">📝 Justificado</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($students as $student)
                                        @php
                                            $attendance = $attendances[$student->id] ?? null;
                                            $currentStatus = $attendance->status ?? 'present';
                                        @endphp

                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $student->name }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $student->email }}
                                                </div>
                                            </td>

                                            @foreach (['present' => 'green', 'absent' => 'red', 'late' => 'yellow', 'justified' => 'blue'] as $value => $color)
                                                <td class="px-6 py-4 text-center">
                                                    <input
                                                        type="radio"
                                                        name="status[{{ $student->id }}]"
                                                        value="{{ $value }}"
                                                        @checked($currentStatus === $value)
                                                        class="w-5 h-5 text-{{ $color }}-600 focus:ring-{{ $color }}-500"
                                                    >
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                                No hay alumnos inscriptos en esta clase.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($students->count() > 0)
                            <div class="mt-6 flex justify-between items-center">
                                <p class="text-sm text-gray-600">
                                    Fecha seleccionada: <strong>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</strong>
                                </p>
                                <x-primary-button class="text-lg px-6 py-3">
                                    💾 Guardar Asistencia
                                </x-primary-button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
