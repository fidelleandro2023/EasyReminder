<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center" style="background-image: url('images/login.jpeg'); background-size: cover; background-position: center;">
        <div class="rounded-lg p-8 max-w-md w-full">
            <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
                <div>
                    <img src="{{ asset('images/logo2.png') }}" alt="Logo" style="height: 140px;" class="mx-auto">
                </div>
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <x-label for="email" value="{{ __('Correo electrónico') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Contraseña') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif

                            <x-button class="ms-4">
                                {{ __('Iniciar sesión') }}
                            </x-button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-600">
                            {{ __('¿No tienes una cuenta?') }}
                            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-900 font-bold">
                                {{ __('Regístrate aquí') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
