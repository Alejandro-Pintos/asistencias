<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">
                        Bienvenido, {{ auth()->user()->name }} 🛠️
                    </h3>

                    <p class="text-sm text-gray-600 mb-4">
                        Desde este panel de <strong>administrador</strong> vas a poder:
                    </p>

                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                        <li>Gestionar los usuarios del sistema (profesores y alumnos).</li>
                        <li>Crear y administrar las clases/cursos.</li>
                        <li>Asignar profesores y alumnos a cada clase.</li>
                    </ul>

                    <p class="mt-4 text-sm text-gray-500">
                        En las siguientes fases vamos a construir estas secciones paso a paso.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
