<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Panel de Profesor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Bienvenida -->
            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">
                        👋 Bienvenido, {{ auth()->user()->name }}
                    </h3>
                    <p class="text-blue-100">
                        Gestiona la asistencia de tus clases
                    </p>
                </div>
            </div>

            @php
                $classes = auth()->user()->classroomsAsTeacher;
            @endphp

            <div class="bg-[#1A2236] overflow-hidden shadow-lg sm:rounded-lg border border-[#2A3548]">
                <div class="p-6">
                    <h4 class="text-lg font-semibold mb-4 text-gray-800">
                        Mis Clases
                    </h4>

                    @if ($classes->isEmpty())
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">
                                Todavía no tenés clases asignadas.
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                El administrador puede crear clases y asignártelas.
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($classes as $classroom)
                                <a href="{{ route('profesor.classrooms.attendance.edit', $classroom) }}"
                                   class="block bg-[#232E47] border-2 border-[#2A3548] rounded-lg p-4 hover:border-green-500 hover:shadow-lg transition-all">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <h5 class="font-bold text-white text-lg">
                                                {{ $classroom->name }}
                                            </h5>
                                            @if($classroom->subject)
                                                <p class="text-sm text-gray-400">
                                                    {{ $classroom->subject }}
                                                </p>
                                            @endif
                                        </div>
                                        @if($classroom->shift)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $classroom->shift === 'mañana' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                                {{ $classroom->shift === 'tarde' ? 'bg-orange-500/20 text-orange-400' : '' }}
                                                {{ $classroom->shift === 'noche' ? 'bg-indigo-500/20 text-indigo-400' : '' }}">
                                                {{ ucfirst($classroom->shift) }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center text-sm text-gray-400 mb-3">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $classroom->students->count() }} alumno(s)
                                    </div>

                                    <div class="flex items-center text-green-400 text-sm font-medium">
                                        Tomar asistencia
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
