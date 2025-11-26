<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Alumno
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.alumnos.update', $alumno) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Nombre completo" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $alumno->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" value="Correo electrónico" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $alumno->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Clases -->
                        <div>
                            <x-input-label for="classrooms" value="Clases inscripto" />
                            <div class="mt-2 space-y-2 max-h-96 overflow-y-auto border border-gray-300 rounded-md p-4 bg-gray-50">
                                @forelse($classrooms as $classroom)
                                    <label class="flex items-start space-x-3 p-3 hover:bg-white rounded cursor-pointer transition">
                                        <input 
                                            type="checkbox" 
                                            name="classrooms[]" 
                                            value="{{ $classroom->id }}"
                                            {{ in_array($classroom->id, old('classrooms', $alumnoClassrooms)) ? 'checked' : '' }}
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
                                                <span class="ml-2 text-gray-500">
                                                    • Profesor: {{ $classroom->teacher->name ?? 'Sin asignar' }}
                                                </span>
                                            </div>
                                        </div>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-500 text-center py-4">No hay clases disponibles</p>
                                @endforelse
                            </div>
                            <p class="mt-1 text-xs text-gray-600">Selecciona las clases en las que está inscripto el alumno</p>
                            <x-input-error :messages="$errors->get('classrooms')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('admin.alumnos.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                            <x-primary-button>
                                Actualizar Alumno
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
