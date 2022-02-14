@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ asset('img/parasite.jpg') }}" alt="parasite" class="md:w-96">
            <div class="mt-3 md:ml-24 md:mt-0">
                <h2 class="text-4xl font-semibold">Parasite (2019)</h2>
                <div class="flex flex-wrap items-center text-gray-200 mt-2">
                    <span class="text-yellow-500"><i class="fa-solid fa-star"></i></span>
                    <span class="ml-1">85%</span>
                    <span class="mx-2">|</span>
                    <span>Feb 20,2020</span>
                    <span class="mx-2">|</span>
                    <span>Action, Thriller, Comedy</span>
                </div>
                <p class="text-gray-300 mt-8">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae officiis totam, repellendus quas incidunt ipsum? Autem, porro rem consequatur illum accusantium facilis totam, non maiores nesciunt ad, molestiae obcaecati quidem animi debitis officia unde. Laborum corrupti modi nihil fugit quis praesentium nisi repudiandae quidem at, saepe suscipit qui ea a officia cupiditate aut beatae, repellat perspiciatis eos. Esse sit laborum architecto eum doloremque illum perspiciatis reiciendis suscipit facere vero dicta impedit molestias rem, a, dolorum voluptatem? Voluptate, sunt. At illum tempora nesciunt ex rem cupiditate possimus, quia itaque debitis tenetur, esse explicabo laboriosam optio ipsum! Architecto deserunt minima consectetur voluptatibus.
                </p>
                <div class="mt-10">
                    <h4 class="text-white font-semibold">Feature Cast</h4>
                    <div class="flex mt-4">
                        <div>
                            <div>Bong Joon-ho</div>
                            <div class="text-sm text-gray-400">Screeplay, Director, Story</div>
                        </div>
                        <div class="ml-8">
                            <div>Han Jin-won</div>
                            <div class="text-sm text-gray-400">Screenplay</div>
                        </div>
                    </div>
                </div>
                <div class="mt-12">
                    <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                        <i class="fa-regular fa-circle-play"></i>
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/actor1.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300">Actor Name</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span>In Film Name</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/actor2.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300">Actor Name</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span>In Film Name</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/actor3.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300">Actor Name</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span>In Film Name</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/actor4.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300">Actor Name</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span>In Film Name</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/actor5.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300">Actor Name</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span>In Film Name</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/image1.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/image2.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/image3.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/image4.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/image5.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('img/image6.jpg') }}" alt="parasite" class="hover:opacity-75 transition ease-in-out duration-1">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection