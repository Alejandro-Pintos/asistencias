<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Sistema de Asistencias</h2>
        <p class="text-sm text-gray-600 mt-2">Ingresa tus credenciales para continuar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="correo@ejemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-800 underline" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center">
                Iniciar Sesión
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div class="text-center text-sm text-gray-600">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    Regístrate aquí
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
