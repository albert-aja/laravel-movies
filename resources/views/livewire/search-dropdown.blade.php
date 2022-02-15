<div class="relative mt-3 md:mt-0" x-data="{isOpen: true}" @click.away="isOpen = false">
    <input 
        wire:model.debounce.500ms="search" 
        type="text" name="search" id="search" 
        class="bg-gray-700 rounded-full w-64 px-4 pl-11 py-1 focus:outline-none focus:shadow-outline" placeholder="Search..." 
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0 mt-1 ml-4 text-gray-400">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    
    <div wire:loading class="spinner top-0 right-0 mr-6 mt-4"></div>

    <div class="absolute bg-gray-800 rouded w-64 mt-4 z-10" x-show.transition.opacity="isOpen">
        <ul>
            @forelse ($searchResults as $result)
                <li class="border-gray-700 border-b">
                    <a 
                        href="{{ route('movies.show', $result['id']) }}"
                        class="hover:bg-gray-700 p-3 flex items-center"
                        @if ($loop->last)
                            @keydown.tab="isOpen = false"
                        @endif
                    >
                        @if ($result['poster_path'])
                            <img src="{{ config('services.tmdb.search_img').$result['poster_path'] }}" alt="" class="w-8">
                        @else
                            <img src="https://via.placeholder.com/50x75" alt="" class="w-8">
                        @endif
                        <span class="ml-4">
                            {{ $result['title'] }}
                        </span>
                    </a>
                </li>
            @empty
                @if (strlen($search) >= 2)
                    <div class="p-3">
                        No result found for '{{ $search }}'
                    </div>
                @endif
            @endforelse
        </ul>
    </div>
</div>