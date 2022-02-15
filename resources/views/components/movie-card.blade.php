<div class="mt-8">
    <a href="{{ route('movies.show', $movie['id']) }}">
        <img src="{{ config('services.tmdb.img').$movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-1">
    </a>
    <div class="mt-2">
        <a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span class="text-yellow-500"><i class="fa-solid fa-star"></i></span>
            <span class="ml-1">{{ $movie['vote_average'] * 10 }}%</span>
            <span class="mx-2">|</span>
            <span>{{ \App\Helpers\General::b_date($movie['release_date']) }}</span>
        </div>
        <div class="text-gray-400 text-sm">
            @foreach ($movie['genre_ids'] as $genre)
                {{ $genreList->get($genre) }}@if (!$loop->last),@endif
            @endforeach
        </div>
    </div>
</div>