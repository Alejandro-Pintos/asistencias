
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-tight">
            {{ __('Panel principal') }}
        </h2>
    </x-slot>

    <div class="min-h-[60vh] flex items-center justify-center py-12">
        <div class="w-full max-w-xl mx-auto px-4">
            <div class="bg-[#1A2236] rounded-2xl shadow-2xl p-10 flex flex-col items-center border border-[#2A3548]">
                <svg class="w-16 h-16 text-green-400 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6 4a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <h3 class="text-2xl font-semibold text-white mb-2">¡Bienvenido/a!</h3>
                <p class="text-gray-400 text-center mb-4">Has iniciado sesión correctamente.<br>Utiliza el menú superior para navegar por el sistema de asistencias.</p>
                <a href="/" class="mt-2 inline-block px-6 py-2.5 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition font-semibold text-sm">Ir al inicio</a>
            </div>
        </div>
    </div>
</x-app-layout>
