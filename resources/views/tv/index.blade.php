@extends('layouts.main')

@section('title', 'TV Shows')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tvshows">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Populer TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTV as $show)
                    <x-tv-show-card :show="$show"/>
                @endforeach
            </div>
        </div>

        <div class="toprated-tvshows py-20 border-b border-gray-800">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRatedTV as $show)
                    <x-tv-show-card :show="$show"/>
                @endforeach
            </div>
        </div>

        <div class="airingtoday-tvshows py-20 border-b border-gray-800">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Airing Today TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($airingTodayTV as $show)
                    <x-tv-show-card :show="$show"/>
                @endforeach
            </div>
        </div>

        <div class="onair-tvshows py-20 border-b border-gray-800">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">On Air TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($onAirTV as $show)
                    <x-tv-show-card :show="$show"/>
                @endforeach
            </div>
        </div>
    </div>
    
@endsection