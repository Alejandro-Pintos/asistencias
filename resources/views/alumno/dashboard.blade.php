<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Alumno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">
                        Hola, {{ auth()->user()->name }} 🙋‍♂️
                    </h3>

                    <p class="text-sm text-gray-600 mb-4">
                        Este es tu panel como <strong>alumno</strong>.
                        Desde acá vas a poder:
                    </p>

                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
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
       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md
              font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500
              focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Ver mis asistencias
    </a>
</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
