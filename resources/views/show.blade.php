@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ config('services.tmdb.img').$detail['poster_path'] }}" alt="{{ $detail['title'] }}" class="w-64 lg:w-96">
            <div class="mt-3 md:ml-24 md:mt-0">
                <h2 class="text-4xl font-semibold">{{ $detail['title'] }} ({{ \App\Helpers\General::release_date($detail['release_date']) }})</h2>
                <div class="flex flex-wrap items-center text-gray-200 mt-2">
                    <span class="text-yellow-500"><i class="fa-solid fa-star"></i></span>
                    <span class="ml-1">{{ $detail['vote_average'] * 10 }}%</span>
                    <span class="mx-2">|</span>
                    <span>{{ \App\Helpers\General::b_date($detail['release_date']) }}</span>
                    <span class="mx-2">|</span>
                    <span class="ml-1">
                        @foreach ($detail['genres'] as $genre)
                        {{ $genre['name'] }}@if (!$loop->last), @endif
                        @endforeach
                    </span>
                    <span class="mx-2">|</span>
                    <span>{{ $detail['runtime'] }} minutes</span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{ $detail['overview'] }}
                </p>

                <div class="mt-10">
                    <h4 class="text-white font-bold text-lg">Feature Cast</h4>
                    <div class="mt-4">
                        @php
                            $director = [];
                            $producer = [];

                            foreach($detail['credits']['crew'] as $crew){
                                if(array_search('Director', $crew)){
                                    array_push($director, $crew['name']);
                                }

                                if(array_search('Producer', $crew)){
                                    array_push($producer, $crew['name']);
                                }
                            }
                        @endphp

                        <p class="w-full">
                            <span class="font-semibold">Director: </span>
                        @foreach ($director as $d)
                            {{ $d }}@if (!$loop->last), @endif
                        @endforeach
                        </p>

                        <p class="w-full">
                            <span class="font-semibold">Producer: </span>
                        @foreach ($producer as $p)
                            {{ $p }}@if (!$loop->last), @endif
                        @endforeach
                        </p>
                    </div>
                </div>

                <div x-data="{ isOpen: false, trailer: '' }">
                    @if ($detail['videos']['results'])
                    <div class="mt-10">
                        <h4 class="text-white font-bold text-lg">Trailer</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($detail['videos']['results'] as $video)
                                @if ($video['official'] && $video['type'] === 'Trailer')
                                    <div class="mt-8 relative">
                                        <button
                                            @click="
                                                isOpen = true
                                                trailer='https://www.youtube.com/embed/{{ $video['key'] }}'
                                            "
                                        >
                                            <img src="http://i1.ytimg.com/vi/{{ $video['key'] }}/hqdefault.jpg" alt="Thumbnail" class="aspect-video cursor-pointer">
                                            <span class="absolute top-0 left-0 bottom-0 right-0 flex justify-center items-center text-5xl group">
                                                <i class="fa-regular fa-circle-play w-full opacity-0 group-hover:opacity-100 transition ease-in-out duration-1"></i>
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
                                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" :src="trailer" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($detail['credits']['cast'] as $cast)
                    @if ($loop->index < 5)
                        <div class="mt-8">
                            <a href="#">
                                <img src="{{ is_null($cast['profile_path']) ? (($cast['gender'] == 1) ? asset('img/woman-placeholder.jpg') : asset('img/man-placeholder.jpg')) : config('services.tmdb.img').$cast['profile_path'] }}" alt="{{ $cast['original_name'] }}" class="hover:opacity-75 transition ease-in-out duration-1">
                            </a>
                            <div class="mt-2">
                                <a href="#" class="text-lg mt-2 hover:text-gray-300">{{ $cast['original_name'] }}</a>
                                <div class="flex items-center text-gray-400 text-sm mt-1">
                                    <span>{{ $cast['character'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    @if ($detail['images']['backdrops'])
    <div class="movie-images" x-data="{ isOpen: false, image: ''}">
        <div class="movie-image border-b border-gray-800">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach ($detail['images']['backdrops'] as $image)
                        @if ($loop->index < 9)
                            <div class="mt-8">
                                <a
                                    @click.prevent="
                                        isOpen = true
                                        image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                                    "
                                    href="#"
                                >
                                    <img src="{{ config('services.tmdb.img').$image['file_path'] }}" alt="{{ $detail['title'] }}" class="hover:opacity-75 transition ease-in-out duration-1">
                                </a>
                            </div>
                        @endif
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