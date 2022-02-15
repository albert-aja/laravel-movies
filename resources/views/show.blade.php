@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <a href="{{ $detail['homepage'] ?? '#' }}">
                <img src="{{ config('services.tmdb.img').$detail['poster_path'] }}" alt="{{ $detail['title'] }}" class="w-full">
            </a>
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
                <div class="mt-10">
                    <h4 class="text-white font-bold text-lg">Trailer</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($detail['videos']['results'] as $video)
                            @if ($video['official'] && $video['type'] === 'Trailer')
                                <div class="mt-8">
                                    <iframe src="https://www.youtube.com/embed/{{ $video['key'] }}" frameborder="0" allowfullscreen class="w-full aspect-video"></iframe>
                                </div>
                            @endif
                        @endforeach
                    </div>
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

    <div class="movie-image border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($detail['images']['backdrops'] as $image)
                    @if ($loop->index < 9)
                        <div class="mt-8">
                            <img src="{{ config('services.tmdb.img').$image['file_path'] }}" alt="{{ $detail['title'] }}" class="hover:opacity-75 transition ease-in-out duration-1">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection