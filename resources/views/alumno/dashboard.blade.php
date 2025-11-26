<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Panel de Alumno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-[#1A2236] overflow-hidden shadow-lg sm:rounded-lg border border-[#2A3548]">
                <div class="p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">
                        Hola, {{ auth()->user()->name }} 🙋‍♂️
                    </h3>

                    <p class="text-sm text-gray-400 mb-4">
                        Este es tu panel como <strong class="text-white">alumno</strong>.
                        Desde acá vas a poder:
                    </p>

                    <ul class="list-disc list-inside text-sm text-gray-300 space-y-1">
                        <li>Ver en qué clases/cursos estás inscripto.</li>
                        <li>Ver la lista de tus compañeros y su estado de asistencia.</li>
                        <li>Consultar tu historial de inasistencias.</li>
                    </ul>

                    <p class="mt-4 text-sm text-gray-500">
                        Más adelante vamos a mostrar tus clases reales desde la base de datos
                        y las asistencias en tiempo real.
                    </p>
                    <div class="mt-6">
    <a href="{{ route('alumno.attendances.index') }}"
       class="inline-flex items-center px-4 py-2.5 bg-green-500 border border-transparent rounded-lg
              font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600
              focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition shadow-lg">
        Ver mis asistencias
    </a>
</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
