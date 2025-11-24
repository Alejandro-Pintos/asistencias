<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencias en tiempo real</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 flex items-start justify-center py-10">

    <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl p-8 space-y-6">
        <header class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Asistencias en tiempo real</h1>
                <p class="text-sm text-slate-500">
                    Ingresá el nombre y registrá la asistencia.
                </p>
            </div>
        </header>

        {{-- FORMULARIO --}}
        <form
            id="attendance-form"
            method="POST"
            action="{{ route('attendances.store') }}"
            class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-end"
        >
            @csrf

            <div class="flex-1">
                <label for="person_name" class="block text-sm font-medium text-slate-700 mb-1">
                    Nombre y apellido
                </label>
                <input
                    type="text"
                    name="person_name"
                    id="person_name"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ej: Alejandro Pintos"
                    required
                >
            </div>

            <button
                type="submit"
                class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition active:scale-[0.98]"
            >
                Marcar asistencia
            </button>
        </form>

        {{-- TABLA --}}
        <section class="border border-slate-200 rounded-lg overflow-hidden bg-slate-50">
            <div class="px-4 py-2 border-b border-slate-200 bg-slate-100">
                <h2 class="text-sm font-semibold text-slate-700 tracking-wide">
                    Listado de asistencias (últimas 50)
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Persona</th>
                            <th class="px-4 py-2 text-left">Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody id="attendances-body" class="divide-y divide-slate-200 bg-white">
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td class="px-4 py-2 text-slate-500">{{ $attendance->id }}</td>
                                <td class="px-4 py-2 font-medium text-slate-800">{{ $attendance->person_name }}</td>
                                <td class="px-4 py-2 text-slate-500">
                                    {{ $attendance->created_at->format('d/m/Y H:i:s') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-slate-400 text-sm">
                                    Todavía no hay asistencias registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</body>
</html>
