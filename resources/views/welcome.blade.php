<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Reminder</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('/images/welcome.jpeg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative flex justify-center items-center min-h-screen bg-gray-900/60">
        <div class="absolute top-8 right-8">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white font-semibold hover:underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-white font-semibold hover:underline">Registrarse</a>
                    @endif
                @endauth
            @endif
        </div>

        <div class="max-w-5xl text-center text-white">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="mx-auto mb-8 w-32">
            <h1 class="text-4xl font-bold mb-6">Bienvenido a Easy Reminder</h1>
            <p class="mb-12 text-lg">La solución perfecta para organizar y gestionar tus pagos con facilidad y eficiencia.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Pagos Regulares -->
                <div class="bg-white bg-opacity-90 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Pagos Regulares</h2>
                    <p class="text-gray-600 text-sm">Gestiona todos tus pagos mensuales de manera sencilla y recibe recordatorios oportunos para evitar olvidos.</p>
                </div>

                <!-- Pagos Recurrentes -->
                <div class="bg-white bg-opacity-90 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Pagos Recurrentes</h2>
                    <p class="text-gray-600 text-sm">Automatiza el seguimiento de tus pagos recurrentes, como suscripciones o servicios, y mantén todo bajo control.</p>
                </div>

                <!-- Análisis de Gastos -->
                <div class="bg-white bg-opacity-90 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Análisis de Gastos</h2>
                    <p class="text-gray-600 text-sm">Visualiza tus gastos en gráficos y obtén estadísticas claras para mejorar tu planificación financiera.</p>
                </div>

                <!-- Historial de Pagos -->
                <div class="bg-white bg-opacity-90 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Historial de Pagos</h2>
                    <p class="text-gray-600 text-sm">Consulta todos tus pagos realizados en un solo lugar y mantén un registro completo de tus transacciones.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
