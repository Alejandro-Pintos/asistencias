@extends('layouts.welcome')

@section('title', 'Crear Cuenta')

@section('formulario')
    <form method="POST" action="{{ route('register') }}" class="w-full max-w-md space-y-3">
        @csrf
        
        <div class="text-center mb-3">
            <h2 class="text-xl font-bold text-white mb-1">Crear Cuenta</h2>
            <p class="text-gray-400 text-xs">Regístrate para comenzar</p>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-gray-300 mb-1.5 text-sm font-medium">Nombre Completo</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}"
                placeholder="Tu nombre"
                class="w-full rounded-lg px-3 py-2 bg-[#19203A] text-white text-sm border border-[#2A3548] focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all" 
                required 
                autofocus>
            @error('name')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-gray-300 mb-1.5 text-sm font-medium">Correo Electrónico</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}"
                placeholder="tu@email.com"
                class="w-full rounded-lg px-3 py-2 bg-[#19203A] text-white text-sm border border-[#2A3548] focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all" 
                required>
            @error('email')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-gray-300 mb-1.5 text-sm font-medium">Contraseña</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="••••••••"
                class="w-full rounded-lg px-3 py-2 bg-[#19203A] text-white text-sm border border-[#2A3548] focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all" 
                required>
            @error('password')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-gray-300 mb-1.5 text-sm font-medium">Confirmar Contraseña</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                placeholder="••••••••"
                class="w-full rounded-lg px-3 py-2 bg-[#19203A] text-white text-sm border border-[#2A3548] focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all" 
                required>
            @error('password_confirmation')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Classrooms Selection -->
        <div>
            <label class="block text-gray-300 mb-1.5 text-sm font-medium">Clases a Inscribirse</label>
            <div class="bg-[#19203A] rounded-lg p-2 max-h-32 overflow-y-auto border border-[#2A3548] space-y-1">
                @forelse($classrooms ?? [] as $classroom)
                    <label class="flex items-start p-1.5 hover:bg-[#1F2847] rounded cursor-pointer transition-colors">
                        <input type="checkbox" name="classrooms[]" value="{{ $classroom->id }}" class="mt-0.5 rounded bg-[#2A3548] border-[#2A3548] text-green-500 focus:ring-green-500 w-4 h-4">
                        <div class="ml-2">
                            <span class="text-white block text-sm">{{ $classroom->name }}</span>
                            <span class="text-gray-400 text-xs">{{ $classroom->subject }}</span>
                        </div>
                    </label>
                @empty
                    <p class="text-gray-500 text-xs text-center py-3">No hay clases disponibles</p>
                @endforelse
            </div>
            @error('classrooms')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2.5 rounded-lg transition-colors shadow-lg hover:shadow-xl mt-4 text-sm">
            Registrarse
        </button>

        <div class="text-center text-gray-400 mt-3 text-xs">
            ¿Ya tienes cuenta? 
            <a href="{{ route('login') }}" class="text-green-400 hover:text-green-300 font-semibold transition-colors">
                Inicia sesión
            </a>
        </div>
    </form>
@endsection
