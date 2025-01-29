<nav aria-label="breadcrumb" class="text-sm text-gray-600">
    <ol class="flex items-center space-x-2">
        <li>
            <a href="{{ route('dashboard') }}" class="hover:text-blue-600">
                <i class="fas fa-home"></i>
            </a>
        </li> 
        <li>
            <span class="text-gray-400">/</span>
        </li> 
        @foreach ($breadcrumb as $item)
        @if ($loop->last)
        <li class="text-gray-500">
            {{ $item->name }}
        </li>
        @else
        <li>
            <a href="{{ $item->url }}" class="hover:text-blue-600">
                {{ $item->name }}
            </a>
        </li>
        <li>
            <span class="text-gray-400">/</span>
        </li>
        @endif
        @endforeach
    </ol>
</nav>