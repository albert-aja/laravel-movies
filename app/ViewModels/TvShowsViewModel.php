<?php

namespace App\ViewModels;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class TvShowsViewModel extends ViewModel
{
    public $popularTV;
    public $topRatedTV;
    public $airingTodayTV;
    public $onAirTV;
    public $genreList;

    public function __construct($popularTV, $topRatedTV, $airingTodayTV, $onAirTV, $genreList){
        $this->popularTV        = $popularTV;
        $this->topRatedTV       = $topRatedTV;
        $this->airingTodayTV    = $airingTodayTV;
        $this->onAirTV          = $onAirTV;
        $this->genreList        = $genreList;
    }

    public function formatShows($shows_arr){
        return collect($shows_arr)->map(function($show){
            $genres = collect($show['genre_ids'])->mapWithKeys(function($genre){
                return [$genre => $this->genreList()->get($genre)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path'       => config('services.tmdb.img').$show['poster_path'],
                'vote_average'      => ($show['vote_average'] > 0) 
                                        ? ($show['vote_average'] * 10 . '%') : 'N/A',
                'first_air_date'    => General::b_date($show['first_air_date']),
                'genres'            => $genres
            ])->only([
                'poster_path', 'vote_average', 'first_air_date', 'genres', 'name', 'id'
            ]);
        });

    }

    public function popularTV(){
        return $this->formatShows($this->popularTV);
    }

    public function topRatedTV(){
        return $this->formatShows($this->topRatedTV);
    }

    public function airingTodayTV(){
        return $this->formatShows($this->airingTodayTV);
    }

    public function onAirTV(){
        return $this->formatShows($this->onAirTV);
    }

    public function genreList(){
        return collect($this->genreList)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
}