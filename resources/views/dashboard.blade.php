
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-indigo-700 tracking-tight drop-shadow-sm">
            {{ __('Panel principal') }}
        </h2>
    </x-slot>

    <div class="min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-50 py-12">
        <div class="w-full max-w-xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-10 flex flex-col items-center">
                <svg class="w-16 h-16 text-indigo-400 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6 4a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">¡Bienvenido/a!</h3>
                <p class="text-gray-600 text-center mb-4">Has iniciado sesión correctamente.<br>Utiliza el menú superior para navegar por el sistema de asistencias.</p>
                <a href="/" class="mt-2 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">Ir al inicio</a>
            </div>
        </div>
    </div>
</x-app-layout>
