@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800 bg-no-repeat bg-cover bg-center" style="background-image:radial-gradient(rgba(11, 23, 34, 0.8) 0%, rgba(8, 24, 39, 0.8) 35%, rgba(17, 24, 39) 100% ), url({{ $detail['backdrop_path'] }})">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row md:grid md:grid-cols-4">
            <img src="{{ $detail['poster_path'] }}" alt="{{ $detail['title'] }}" class="w-full rounded-lg">
            <div class="mt-3 md:ml-24 md:mt-0 md:col-start-2 md:col-span-3">
                <h2 class="text-4xl font-semibold">{{ $detail['title'] }} ({{ $detail['release_year'] }})</h2>
                <div class="flex flex-wrap items-center text-gray-200 mt-2">
                    <span class="text-yellow-500"><i class="fa-solid fa-star"></i></span>
                    <span class="ml-1">{{ $detail['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $detail['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span class="ml-1">
                        {{ $detail['genres'] }}
                    </span>
                    <span class="mx-2">|</span>
                    <span>{{ $detail['runtime'] }}</span>
                </div>

                <div class="mt-10">
                    <h4 class="text-white font-bold text-lg">Overview</h4>
                    <p class="text-gray-300 mt-4 text-justify">
                        {{ $detail['overview'] }}
                    </p>
                </div>

                <div class="mt-10">
                    <h4 class="text-white font-bold text-lg">Feature Cast</h4>
                    <div class="mt-4">
                        <p class="w-full text-gray-300">
                            <span class="font-semibold">Director: </span>
                            {{ $detail['director'] }}
                        </p>

                        <p class="w-full text-gray-300">
                            <span class="font-semibold">Producer: </span>
                            {{ $detail['producer'] }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($detail['casters'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('people.show', $cast['id']) }}">
                            <img src="{{ $cast['profile_path'] }}" alt="{{ $cast['original_name'] }}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('people.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['original_name'] }}</a>
                            <div class="flex items-center text-gray-400 text-sm mt-1">
                                <span>{{ $cast['character'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    @if (!empty($detail['trailers']))
        <div x-data="{ isOpen: false, trailer: '' }">
            <div class="movie-cast border-b border-gray-800">
                <div class="container mx-auto px-4 py-16">
                    <h2 class="text-4xl font-semibold">Trailer</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($detail['trailers'] as $trailer)
                            <div class="mt-8 relative">
                                <button
                                    @click="
                                        isOpen = true
                                        trailer='https://www.youtube.com/embed/{{ $trailer }}'
                                    "
                                >
                                    <img src="http://i1.ytimg.com/vi/{{ $trailer }}/hqdefault.jpg" alt="Thumbnail" class="aspect-video cursor-pointer rounded-lg">
                                    <span class="absolute top-0 left-0 bottom-0 right-0 flex justify-center items-center text-5xl group">
                                        <i class="fa-regular fa-circle-play w-full opacity-0 group-hover:opacity-100 transition ease-in-out duration-150"></i>
                                    </span>
                                </button>
                                <template x-if="isOpen">
                                    <div
                                        style="background-color: rgba(0, 0, 0, .5);"
                                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                    >
                                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                            <div class="bg-gray-900 rounded">
                                                <div class="flex justify-end pr-4 pt-2">
                                                    <button
                                                        @click="isOpen = false"
                                                        @keydown.escape.window="isOpen = false"
                                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                                    </button>
                                                </div>
                                                <div class="modal-body px-8 py-8">
                                                    <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                        <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full rounded-lg" style="border:0;" :src="trailer" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (!empty($detail['images']))
    <div class="movie-images" x-data="{ isOpen: false, image: ''}">
        <div class="movie-image border-b border-gray-800">
            <div class="container w-fit mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach ($detail['images'] as $image)
                        <div class="mt-2">
                            <a
                                @click.prevent="
                                    isOpen = true
                                    image='{{ config('services.tmdb.backdrop').$image['file_path'] }}'
                                "
                                href="#"
                            >
                                <img src="{{ config('services.tmdb.img').$image['file_path'] }}" alt="{{ $detail['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show="isOpen"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="poster">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection