 
    <div id="sidebar"  class="bg-gray-800 text-white w-64 h-full fixed left-0 top-0 shadow-md">
        <div class="p-4 text-lg font-semibold border-b border-gray-700">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 43px;" class="mx-auto">
                </a>
            </div>
        </div>
        <ul class="mt-4">
            <li class="p-4 hover:bg-gray-700">
                <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="p-4 hover:bg-gray-700">
                <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
            </li>
            <li class="p-4 hover:bg-gray-700">
                <a href="{{ route('logout') }}">{{ __('Logout') }}</a>
            </li>
        </ul>
    </div>
 