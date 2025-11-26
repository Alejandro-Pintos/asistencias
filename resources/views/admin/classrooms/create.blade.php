<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nueva Clase/Materia
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.classrooms.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Nombre de la clase" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Ej: 5to A" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Subject -->
                        <div>
                            <x-input-label for="subject" value="Materia (opcional)" />
                            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" placeholder="Ej: Matemática, Lengua, Historia..." />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <!-- Shift -->
                        <div>
                            <x-input-label for="shift" value="Turno" />
                            <select id="shift" name="shift" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                                <option value="">Seleccionar turno...</option>
                                <option value="mañana" {{ old('shift') === 'mañana' ? 'selected' : '' }}>Mañana</option>
                                <option value="tarde" {{ old('shift') === 'tarde' ? 'selected' : '' }}>Tarde</option>
                                <option value="noche" {{ old('shift') === 'noche' ? 'selected' : '' }}>Noche</option>
                            </select>
                            <x-input-error :messages="$errors->get('shift')" class="mt-2" />
                        </div>

                        <!-- Teacher -->
                        <div>
                            <x-input-label for="teacher_id" value="Profesor a cargo" />
                            <select id="teacher_id" name="teacher_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                                <option value="">Seleccionar profesor...</option>
                                @foreach($profesores as $profesor)
                                    <option value="{{ $profesor->id }}" {{ old('teacher_id') == $profesor->id ? 'selected' : '' }}>
                                        {{ $profesor->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                            @if($profesores->isEmpty())
                                <p class="mt-2 text-sm text-red-600">
                                    No hay profesores disponibles. <a href="{{ route('admin.profesores.create') }}" class="underline">Crear un profesor primero</a>
                                </p>
                            @endif
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('admin.classrooms.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                            <x-primary-button>
                                Crear Clase
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
