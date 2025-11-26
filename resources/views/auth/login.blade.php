@extends('layouts.welcome')

@section('title', 'Iniciar Sesión')

@section('formulario')
    <form method="POST" action="{{ route('login') }}" class="w-full max-w-md space-y-4">
        @csrf
        
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold text-white mb-1">Iniciar Sesión</h2>
            <p class="text-gray-400 text-xs">Accede a tu cuenta de asistencias</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-green-500/10 border border-green-500 text-green-400 px-3 py-2 rounded-lg text-xs">
                {{ session('status') }}
            </div>
        @endif

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-gray-300 mb-1.5 text-sm font-medium">Correo Electrónico</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}"
                placeholder="tu@email.com"
                class="w-full rounded-lg px-3 py-2.5 bg-[#19203A] text-white text-sm border border-[#2A3548] focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all" 
                required 
                autofocus>
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
                class="w-full rounded-lg px-3 py-2.5 bg-[#19203A] text-white text-sm border border-[#2A3548] focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all" 
                required>
            @error('password')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded bg-[#19203A] border-[#2A3548] text-green-500 focus:ring-green-500 w-4 h-4">
                <span class="ml-2 text-xs text-gray-400">Recordarme</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs text-green-400 hover:text-green-300 transition-colors">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2.5 rounded-lg transition-colors shadow-lg hover:shadow-xl text-sm">
            Entrar
        </button>

        <div class="text-center text-gray-400 mt-4 text-xs">
            ¿No tienes cuenta? 
            <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300 font-semibold transition-colors">
                Regístrate aquí
            </a>
        </div>
    </form>
@endsection
