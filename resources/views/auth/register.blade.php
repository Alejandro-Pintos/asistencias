<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Crear Cuenta</h2>
        <p class="text-sm text-gray-600 mt-2">Completa el formulario para registrarte como alumno</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nombre completo" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Juan Pérez" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="correo@ejemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Clases -->
        <div>
            <x-input-label for="classrooms" value="Clases a inscribirse" />
            <div class="mt-2 space-y-2 max-h-60 overflow-y-auto border border-gray-300 rounded-md p-3 bg-gray-50">
                @forelse($classrooms as $classroom)
                    <label class="flex items-start space-x-3 p-2 hover:bg-white rounded cursor-pointer transition">
                        <input 
                            type="checkbox" 
                            name="classrooms[]" 
                            value="{{ $classroom->id }}"
                            {{ in_array($classroom->id, old('classrooms', [])) ? 'checked' : '' }}
                            class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        >
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900">{{ $classroom->name }}</div>
                            <div class="text-xs text-gray-600">
                                {{ $classroom->subject ?? 'Sin materia' }}
                                @if($classroom->shift)
                                    <span class="ml-2 px-2 py-0.5 rounded text-xs
                                        {{ $classroom->shift === 'mañana' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $classroom->shift === 'tarde' ? 'bg-orange-100 text-orange-800' : '' }}
                                        {{ $classroom->shift === 'noche' ? 'bg-indigo-100 text-indigo-800' : '' }}">
                                        {{ ucfirst($classroom->shift) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </label>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No hay clases disponibles</p>
                @endforelse
            </div>
            <p class="mt-1 text-xs text-gray-600">Selecciona las clases en las que deseas inscribirte</p>
            <x-input-error :messages="$errors->get('classrooms')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="mt-1 text-xs text-gray-600">Mínimo 8 caracteres</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmar contraseña" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center">
                Registrarse
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-gray-600">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                Inicia sesión aquí
            </a>
        </div>
    </form>
</x-guest-layout>
