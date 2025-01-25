<div id="sidebar" class="bg-gray-800 text-white w-64 h-full fixed left-0 top-0 shadow-md overflow-y-auto">
    <div class="text-lg font-semibold border-b border-gray-700">
        <div class="logo_dashboard flex items-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 43px;margin:3px" class="mx-auto">
            </a>
            <span style="padding-left: 10px;">
                Easy Reminder
            </span>
        </div>
    </div>
    <ul class="mt-4">
    @foreach ($menus as $menu)
        @php
            $userRoles = auth()->user()->roles->pluck('id')->toArray();
            $menuRoles = json_decode($menu->roles);
            $hasPermission = array_intersect($userRoles, $menuRoles);  
        @endphp

        @if ($hasPermission)
            <li class="p-4 hover:bg-gray-700" title="{{ $menu->name }}" id="menu-{{ $menu->id }}">
                <i class="menu-icon {{ $menu->icon }}"></i>
                <a href="{{ $menu->url }}">{{ __($menu->name) }}</a>

                @if ($menu->children->isNotEmpty())
                    <!-- Botón para expandir/contraer submenú -->
                    <button class="expand-menu p-2 text-xs text-gray-400 hover:text-white" data-parent-id="{{ $menu->id }}">
                        <i class="fas fa-plus"></i>
                    </button>

                    <!-- Submenú -->
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
