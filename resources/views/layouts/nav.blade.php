<nav id="navbar" class="border-b border-gray-800">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <ul class="flex items-center flex-col md:flex-row">
            <li>
                <a href="/">
                    <x-logo />
                </a>
            </li>
            <li class="md:ml-16 mt-3 md:mt-0">
                <a href="/" class="hover:text-gray-300">Home</a>
            </li>
            <li class="md:ml-16 mt-3 md:mt-0">
                <a href="/" class="hover:text-gray-300">Movies</a>
            </li>
            <li class="md:ml-11 mt-3 md:mt-0">
                <a href="/tv-show" class="hover:text-gray-300">TV Shows</a>
            </li>
            <li class="md:ml-11 mt-3 md:mt-0">
                <a href="/people" class="hover:text-gray-300">Actors</a>
            </li>
        </ul>
        <div class="flex flex-col md:flex-row items-center">
            <livewire:search-dropdown/>
            {{-- <div class="md:ml-4 mt-3 md:mt-0">
                <a href="#">
                    <img src="{{ asset('img/avatar.png') }}" alt="avatar" class="rounded-full w-8 h-8">
                </a>
            </div> --}}
        </div>
    </div>
</nav>