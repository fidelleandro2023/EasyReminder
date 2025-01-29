<div id="sidebar" x-data="{ collapsed: false }" 
    :class="{ 'w-16': collapsed, 'w-64': !collapsed }" 
    class="bg-gray-800 text-white h-full fixed left-0 top-0 shadow-md transition-all duration-300">
    <!-- Header del Sidebar -->
    <div class="flex justify-between items-center text-lg font-semibold border-b border-gray-700 py-2">
        <!-- Logo -->
        <div class="logo_dashboard flex items-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 43px; margin: 3px;" class="mx-auto">
            </a>
            <span class="ml-2" x-show="!collapsed">Easy Reminder</span>
        </div>

        <!-- Botón cerrar -->
        <button id="closeSidebar"  class="text-gray-400 hover:text-gray-500 hover:bg-gray-100 p-2 rounded focus:outline-none transition duration-150">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Menú -->
    <div class="overflow-y-auto custom-scrollbar">
        <ul class="mt-4" :class="{ 'text-sm': collapsed, 'text-base': !collapsed }">
            @foreach ($menus as $menu)
                @php
                    $userRoles = auth()->user()->roles->pluck('id')->toArray();
                    $menuRoles = json_decode($menu->roles);
                    $hasPermission = array_intersect($userRoles, $menuRoles);  
                @endphp

                @if ($hasPermission)
                    <li class="p-4 hover:bg-gray-700" title="{{ $menu->name }}" id="menu-{{ $menu->id }}">
                        <i class="menu-icon {{ $menu->icon }}"></i>
                        <span x-show="!collapsed" class="menu-text">{{ __($menu->name) }}</span>

                        @if ($menu->children->isNotEmpty()) 
                            <button class="expand-menu p-2 text-xs text-gray-400 hover:text-white" data-parent-id="{{ $menu->id }}">
                                <i class="fas fa-plus"></i>
                            </button>
                            <ul class="submenu hidden pl-4">
                                @foreach ($menu->children as $child)
                                    @php
                                        $childRoles = json_decode($child->roles);
                                        $childPermissions = json_decode($child->permissions);
                                        $userHasChildPermission = array_intersect($userRoles, $childRoles) && 
                                                                (in_array('view', $childPermissions) ? auth()->user()->can('view', $child) : true);
                                    @endphp

                                    @if ($userHasChildPermission)
                                        <li class="p-2 hover:bg-gray-600">
                                            <i class="menu-icon {{ $child->icon }}"></i>
                                            <a href="{{ $child->url }}">{{ __($child->name) }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul> 
    </div> 
</div>
