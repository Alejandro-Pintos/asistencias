<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Panel de Administrador
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Bienvenida -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">
                        👋 Bienvenido, {{ auth()->user()->name }}
                    </h3>
                    <p class="text-green-100">
                        Panel de administración del sistema de asistencias
                    </p>
                </div>
            </div>

            <!-- Accesos rápidos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Gestión de Profesores -->
                <a href="{{ route('admin.profesores.index') }}" class="bg-[#1A2236] overflow-hidden shadow-lg sm:rounded-lg hover:shadow-xl transition-all border border-[#2A3548] hover:border-green-500">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Profesores</h4>
                        <p class="text-sm text-gray-400">Gestionar profesores y preceptores</p>
                    </div>
                </a>

                <!-- Gestión de Clases -->
                <a href="{{ route('admin.classrooms.index') }}" class="bg-[#1A2236] overflow-hidden shadow-lg sm:rounded-lg hover:shadow-xl transition-all border border-[#2A3548] hover:border-green-500">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Clases/Materias</h4>
                        <p class="text-sm text-gray-400">Crear y administrar clases</p>
                    </div>
                </a>

                <!-- Gestión de Alumnos -->
                <a href="{{ route('admin.alumnos.index') }}" class="bg-[#1A2236] overflow-hidden shadow-lg sm:rounded-lg hover:shadow-xl transition-all border border-[#2A3548] hover:border-green-500">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Alumnos</h4>
                        <p class="text-sm text-gray-400">Gestionar estudiantes del sistema</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
