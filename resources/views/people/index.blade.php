@extends('layouts.main')

@section('title', 'Popular People')

@section('content')

    <div class="container mx-auto px-4 py-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Populer Movies</h2>
            <div class="people grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($people as $person)
                <div class="person mt-8">
                    <a href="{{ route('people.show', $person['id']) }}">
                        <img src="{{ $person['profile_path'] }}" alt="{{ $person['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('people.show', $person['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $person['name'] }}</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span>{{ $person['known_for'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner text-4xl my-8"> </div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">No more pages to load</p>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let infScroll = new InfiniteScroll('.people', {
            path: '/people?page=@{{#}}',
            append: '.person',
            history: false,
            status: '.page-load-status'
        });
    </script>
@endsection