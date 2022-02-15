<nav class="border-bottom border-gray-800">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <ul class="flex items-center flex-col md:flex-row">
            <li>
                <a href="/">
                    <x-logo />
                </a>
            </li>
            <li class="md:ml-16 mt-3 md:mt-0">
                <a href="/" class="hover:text-gray-300">Movies</a>
            </li>
            <li class="md:ml-11 mt-3 md:mt-0">
                <a href="#" class="hover:text-gray-300">Tv Shows</a>
            </li>
            <li class="md:ml-11 mt-3 md:mt-0">
                <a href="#" class="hover:text-gray-300">Actors</a>
            </li>
        </ul>
        <div class="flex flex-col md:flex-row items-center">
            <div class="relative mt-3 md:mt-0">
                <input type="text" name="search" id="search" class="bg-gray-700 rounded-full w-64 px-4 pl-11 py-1 focus:outline-none focus:shadow-outline" placeholder="Search...">
                <div class="absolute top-0 mt-1 ml-4 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="#">
                    <img src="{{ asset('img/avatar.jpg') }}" alt="avatar" class="rounded-full w-8 h-8">
                </a>
            </div>
        </div>
    </div>
</nav>