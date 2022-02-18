@extends('layouts.main')

@section('title')
    {{ $detail['name'] }}
@endsection

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row md:grid md:grid-cols-4">
            <div class="flex-none">
                <img src="{{ $detail['profile_path'] }}" alt="{{ $detail['name'] }}" class="w-full rounded-lg">
                <ul class="flex justify-center items-center mt-7 animation ease-in-out duration-150">
                    @if ($detail['social']['facebook'])
                        <li class="mx-4">
                            <a href="{{ $detail['social']['facebook'] }}" title="Facebook" target="_blank">
                                <i class="fa-brands fa-facebook-square fill-current text-gray-400 hover:text-white text-3xl"></i>
                            </a>
                        </li>
                    @endif
    
                    @if ($detail['social']['twitter'])
                        <li class="mx-4">
                            <a href="{{ $detail['social']['twitter'] }}" title="Twitter" target="_blank">
                                <i class="fa-brands fa-twitter fill-current text-gray-400 hover:text-white text-3xl"></i>
                            </a>
                        </li>
                    @endif
    
                    @if ($detail['social']['instagram'])
                        <li class="mx-4">
                            <a href="{{ $detail['social']['instagram'] }}" title="Instagram" target="_blank">
                                <i class="fa-brands fa-instagram fill-current text-gray-400 hover:text-white text-3xl"></i>
                            </a>
                        </li>
                    @endif
    
                    @if ($detail['homepage'])
                        <li class="mx-4">
                            <a href="{{ $detail['homepage'] }}" title="Website" target="_blank">
                                <i class="fa-solid fa-link fill-current text-gray-400 hover:text-white text-3xl"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            
            <div class="mt-3 md:ml-24 md:mt-0 md:col-start-2 md:col-span-3">
                <h2 class="text-4xl font-semibold">{{ $detail['name'] }} ({{ $detail['known_for_department'] }})</h2>
                <div class="flex flex-wrap items-center text-gray-200 mt-2">
                    @if ($detail['birthday'])
                        <i class="fa-solid fa-cake-candles text-gray-600 mr-1.5"></i>
                        <span class="ml-1">{{ $detail['birthday'] }} ({{ $detail['age'] }}) in {{ $detail['place_of_birth'] }}</span>
                        <span class="mx-2">|</span>
                    @endif
                    <span>{!! $detail['gender'] !!}</span>
                </div>

                @if (!empty($detail['biography']))
                    <div class="mt-10">
                        <h4 class="text-white font-bold text-lg">Biography</h4>
                        <p class="text-gray-300 mt-4 text-justify">
                            {{ $detail['biography'] }}
                        </p>
                    </div>
                @endif

                <div class="mt-10 hidden md:block">
                    <h4 class="text-white font-bold text-lg">Known For</h4>
                    <div class="grid grid-cols-7 gap-2">
                    @foreach ($detail['known_for'] as $movie)
                        <div class="mt-4">
                            <a href="{{ route('movies.show', $movie['id']) }}">
                                <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md w-full">
                                <p class="text-sm mt-2 w-11/12 text-center">
                                    {{ $movie['title'] }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if (!empty($detail['images']))
    <div class="person-images" x-data="{ isOpen: false, image: ''}">
        <div class="border-b border-gray-800">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-5">
                    @foreach ($detail['images'] as $image)
                        <div class="mt-8">
                            <a
                                @click.prevent="
                                    isOpen = true
                                    image='{{ $image['file_path'] }}'
                                "
                                href="#"
                            >
                                <img src="{{ $image['file_path'] }}" alt="{{ $detail['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-fullitems-center shadow-lg overflow-y-auto"
                    x-show="isOpen"
                >
                    <div class="w-fit mx-auto lg:px-32 overflow-y-auto">
                        <div class="bg-gray-900 rounded-xl">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body flex justify-center p-8">
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