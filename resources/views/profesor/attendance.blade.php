<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tomar asistencia - {{ $classroom->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET"
                          action="{{ route('profesor.classrooms.attendance.edit', $classroom) }}"
                          class="mb-4 flex items-center gap-2">
                        <label for="date" class="text-sm font-medium text-gray-700">
                            Fecha:
                        </label>
                        <input
                            type="date"
                            id="date"
                            name="date"
                            value="{{ $date }}"
                            class="border-gray-300 rounded-md shadow-sm text-sm"
                        >
                        <x-primary-button class="ml-2">
                            Cambiar fecha
                        </x-primary-button>
                    </form>

                    <form method="POST"
                          action="{{ route('profesor.classrooms.attendance.update', $classroom) }}">
                        @csrf

                        <input type="hidden" name="date" value="{{ $date }}">

                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">Alumno</th>
                                    <th class="px-4 py-2 text-center">Presente</th>
                                    <th class="px-4 py-2 text-center">Ausente</th>
                                    <th class="px-4 py-2 text-center">Tarde</th>
                                    <th class="px-4 py-2 text-center">Justificado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($students as $student)
                                    @php
                                        $attendance = $attendances[$student->id] ?? null;
                                        $currentStatus = $attendance->status ?? 'present';
                                    @endphp

                                    <tr>
                                        <td class="px-4 py-2">
                                            {{ $student->name }}
                                            <div class="text-xs text-gray-500">
                                                {{ $student->email }}
                                            </div>
                                        </td>

                                        @foreach (['present' => 'Presente', 'absent' => 'Ausente', 'late' => 'Tarde', 'justified' => 'Justificado'] as $value => $label)
                                            <td class="px-4 py-2 text-center">
                                                <input
                                                    type="radio"
                                                    name="status[{{ $student->id }}]"
                                                    value="{{ $value }}"
                                                    @checked($currentStatus === $value)
                                                >
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                            No hay alumnos inscriptos en esta clase.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <x-primary-button>
                                Guardar asistencia
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
