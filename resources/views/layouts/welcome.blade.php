<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bienvenido - Asistencias')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0F1729] min-h-screen flex items-center justify-center p-3">
    <div class="flex w-full max-w-5xl mx-auto bg-[#1A2236] rounded-2xl shadow-2xl overflow-hidden" style="max-height: 95vh;">
        <!-- Lado izquierdo - Información -->
        <div class="hidden lg:flex lg:w-5/12 p-6 flex-col justify-start pt-8 bg-[#151D2F]">
            <!-- Logo pequeño -->
            <div class="mb-6">
                <img src="{{ asset('img/aula.jpg') }}" alt="Aula" class="w-16 h-16 rounded-lg object-cover">
            </div>
            
            <div class="space-y-3 mb-6">
                <div class="bg-[#1C2539] rounded-lg p-3 flex items-center gap-3 hover:bg-[#202944] transition-colors">
                    <span class="text-2xl">📊</span>
                    <div>
                        <div class="font-semibold text-white text-sm">Control de Asistencias</div>
                        <div class="text-gray-400 text-xs">Registro y monitoreo en tiempo real</div>
                    </div>
                </div>
                <div class="bg-[#1C2539] rounded-lg p-3 flex items-center gap-3 border-l-4 border-green-400 hover:bg-[#202944] transition-colors">
                    <span class="text-2xl">✔️</span>
                    <div>
                        <div class="font-semibold text-white text-sm">Gestión Simplificada</div>
                        <div class="text-gray-400 text-xs">Administración fácil y eficiente</div>
                    </div>
                </div>
                <div class="bg-[#1C2539] rounded-lg p-3 flex items-center gap-3 hover:bg-[#202944] transition-colors">
                    <span class="text-2xl">💻</span>
                    <div>
                        <div class="font-semibold text-white text-sm">Acceso Multiplataforma</div>
                        <div class="text-gray-400 text-xs">Disponible en cualquier dispositivo</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lado derecho - Formulario -->
        <div class="w-full lg:w-7/12 p-6 lg:p-8 flex flex-col justify-center items-center bg-[#232E47]">
            @yield('formulario')
        </div>
    </div>
</body>
</html>
