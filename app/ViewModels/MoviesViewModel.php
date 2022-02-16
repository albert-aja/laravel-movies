<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Helpers\General;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genreList;

    public function __construct($popularMovies, $nowPlayingMovies, $genreList){
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genreList = $genreList;
    }

    private function formatMovie($movie_arr){
        return collect($movie_arr)->map(function($movie){
            $genres = collect($movie['genre_ids'])->mapWithKeys(function($genre){
                return [$genre => $this->genreList()->get($genre)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path'   => config('services.tmdb.img').$movie['poster_path'],
                'vote_average'  => $movie['vote_average'] * 10 . '%',
                'release_date'  => General::b_date($movie['release_date']),
                'genres'        => $genres
            ])->only([
                'poster_path', 'vote_average', 'release_date', 'genres', 'title', 'id'
            ]);
        });
    }

    public function popularMovies(){
        return $this->formatMovie($this->popularMovies);
    }

    public function nowPlayingMovies(){
        return $this->formatMovie($this->nowPlayingMovies);
    }

    public function genreList(){
        return collect($this->genreList)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
}
