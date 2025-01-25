<div id="sidebar" class="bg-gray-800 text-white w-64 h-full fixed left-0 top-0 shadow-md">
    <div class="text-lg font-semibold border-b border-gray-700">
        <div class="logo_dashboard -0 flex items-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 43px;margin:3px" class="mx-auto">
            </a>
            <span style="padding-left: 10px;">
            Easy Reminder
            </span>
        </div>
    </div>
    <ul class="mt-4">
        <li class="p-4 hover:bg-gray-700" title="Dashboard">
            <i class="menu-icon">🏠</i>
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="p-4 hover:bg-gray-700" title="Pagos">
            <i class="menu-icon">📄</i>
            <a href="{{ route('payments.index') }}">{{ __('Pagos') }}</a>
        </li>
        <li class="p-4 hover:bg-gray-700" title="Logout">
            <i class="menu-icon">⚙️</i>
            <a href="{{ route('logout') }}">{{ __('Logout') }}</a>
        </li>
    </ul>
</div>
 