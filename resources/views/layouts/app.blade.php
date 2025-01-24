<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <title>{{ config('app.name', 'Easy Reminder') }}</title> 
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner /> 
        <livewire:sidebar />   
        <div id="dashboardContent" class="min-h-screen bg-gray-100" style="margin-left: 250px;">  
            @livewire('navigation-menu') 
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif 
            <main>
                {{ $slot }}
            </main>
        </div> 
        @stack('modals') 
        @livewireScripts
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            const $hamburgerButton = $('#hamburgerButton');
            const $sidebar = $('#sidebar');
            const $dashboardContent = $('#dashboardContent');
 
            if ($hamburgerButton.length === 0) {
                console.error('Uno o más elementos no se encontraron en el DOM.');
                return;
            }
 
            $hamburgerButton.on('click', function () {
                console.log('clickkkkk'); 
                const isCollapsed = $sidebar.width() === 50;  
                $sidebar.css('width', isCollapsed ? '250px' : '50px');  
                $dashboardContent.css('margin-left', isCollapsed ? '250px' : '50px');  
            });
        });
    </script>


</html>
