<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Profesor / Preceptor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">
                        Bienvenido, {{ auth()->user()->name }} 👋
                    </h3>

                    @php
                        $classes = auth()->user()->classroomsAsTeacher;
                    @endphp

                    <h4 class="text-md font-semibold mb-2">
                        Tus clases / cursos
                    </h4>

                    @if ($classes->isEmpty())
                        <p class="text-sm text-gray-600">
                            Todavía no tenés clases asignadas.
                            El administrador podrá crearlas y asignártelas.
                        </p>
                    @else
                        <div class="mt-2 space-y-2">
@foreach ($classes as $classroom)
    <a href="{{ route('profesor.classrooms.attendance.edit', $classroom) }}"
       class="block border rounded-md px-3 py-2 text-sm text-gray-800 bg-gray-50 hover:bg-gray-100 transition">
        <div class="font-semibold">
            {{ $classroom->name }}
            @if($classroom->subject)
                – {{ $classroom->subject }}
            @endif
        </div>
        <div class="text-xs text-gray-600">
            ID: {{ $classroom->id }}
        </div>
        <div class="text-xs text-blue-600 mt-1">
            Tomar asistencia →
        </div>
    </a>
@endforeach

                        </div>
                    @endif

                    <p class="mt-6 text-sm text-gray-500">
                        Después, desde cada clase vas a poder abrir la pantalla para
                        tomar asistencia por fecha y ver el historial.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
