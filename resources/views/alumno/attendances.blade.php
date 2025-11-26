<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis asistencias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">
                        {{ $student->name }}
                    </h3>

                    {{-- Resumen rápido --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 text-sm">
                        <div class="border rounded-md p-3 bg-gray-50">
                            <div class="font-semibold text-gray-700">Total registros</div>
                            <div class="text-2xl">
                                {{ $attendances->count() }}
                            </div>
                        </div>
                        <div class="border rounded-md p-3 bg-gray-50">
                            <div class="font-semibold text-green-700">Presentes</div>
                            <div class="text-2xl">
                                {{ $summary['present'] ?? 0 }}
                            </div>
                        </div>
                        <div class="border rounded-md p-3 bg-gray-50">
                            <div class="font-semibold text-red-700">Ausentes</div>
                            <div class="text-2xl">
                                {{ $summary['absent'] ?? 0 }}
                            </div>
                        </div>
                        <div class="border rounded-md p-3 bg-gray-50">
                            <div class="font-semibold text-yellow-700">Tarde / Justif.</div>
                            <div class="text-xs">
                                Tarde: {{ $summary['late'] ?? 0 }}<br>
                                Justificado: {{ $summary['justified'] ?? 0 }}
                            </div>
                        </div>
                    </div>

                    {{-- Tabla --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">Fecha</th>
                                    <th class="px-4 py-2 text-left">Clase</th>
                                    <th class="px-4 py-2 text-left">Materia</th>
                                    <th class="px-4 py-2 text-left">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @forelse ($attendances as $attendance)
                                    <tr>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $attendance->classroom->name ?? '—' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $attendance->classroom->subject ?? '—' }}
                                        </td>

                                        @php
                                            $labels = [
                                                'present' => 'Presente',
                                                'absent' => 'Ausente',
                                                'late' => 'Tarde',
                                                'justified' => 'Justificado',
                                            ];
                                            $colors = [
                                                'present' => 'text-green-700 bg-green-100',
                                                'absent' => 'text-red-700 bg-red-100',
                                                'late' => 'text-yellow-700 bg-yellow-100',
                                                'justified' => 'text-blue-700 bg-blue-100',
                                            ];
                                            $status = $attendance->status;
                                        @endphp

                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$status] ?? '' }}">
                                                {{ $labels[$status] ?? $status }}
                                            </span>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                            Todavía no hay registros de asistencia.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- ===================== WEBSOCKETS DEL ALUMNO ===================== --}}
    @php
        $classroomIds = $attendances->pluck('classroom_id')->unique()->values();
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            console.log('%c[alumno] Script cargado', 'color: dodgerblue');

            if (!window.Echo) {
                console.error('[alumno] Echo no está definido');
                return;
            }

            const classroomIds = @json($classroomIds);
            console.log('[alumno] classroomIds:', classroomIds);

            if (!classroomIds.length) {
                console.log('[alumno] Sin clases para suscribirse');
                return;
            }

            classroomIds.forEach(id => {
                console.log('[alumno] → Subscribiendo a classroom.' + id);

                const channel = window.Echo.channel('classroom.' + id);
                
                // Escuchar el evento sin el punto inicial
                channel.listen('.AttendanceUpdated', (event) => {
                    console.log('%c[alumno] ✅ Evento .AttendanceUpdated recibido - RECARGANDO PÁGINA', 'color: green; font-weight: bold; font-size: 14px', event);
                    window.location.reload();
                });
                
                channel.listenToAll((eventName, data) => {
                    console.log('%c[alumno] 📡 Cualquier evento recibido:', 'color: orange', eventName, data);
                    
                    // Fallback: recargar con cualquier evento
                    if (eventName === '.AttendanceUpdated') {
                        console.log('[alumno] ⚡ Recargando por listenToAll');
                        window.location.reload();
                    }
                });
                
                console.log('[alumno] ✓ Listeners registrados para classroom.' + id);
            });

        });
    </script>

</x-app-layout>
