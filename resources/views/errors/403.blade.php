<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 | No Autorizado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/unauthorized.jpeg') }}');">
    <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-xl text-center max-w-lg">
        <h1 class="text-6xl font-bold text-red-500 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Acceso No Autorizado</h2>
        <p class="text-gray-600 mb-6">Lo sentimos, no tienes permiso para acceder a esta página.</p>
        <div class="flex justify-center space-x-4">
            <a href="javascript:history.back()" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-300">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ url('/') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                <i class="fas fa-home"></i> Ir al Inicio
            </a>
        </div>
    </div>
</body>
</html>
