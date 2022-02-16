<?php

namespace App\ViewModels;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $detail;
    
    public function __construct($detail){
        $this->detail = $detail;
    }

    public function detail(){
        $director = [];
        $producer = [];
        $trailer = [];

        foreach($this->detail['credits']['crew'] as $crew){
            if(array_search('Director', $crew)){
                array_push($director, $crew['name']);
            }

            if(array_search('Producer', $crew)){
                array_push($producer, $crew['name']);
            }
        }

        $sortedVideo = collect($this->detail['videos']['results'])->sortBy('published_at');

        foreach($sortedVideo as $video){
            if($video['official'] && $video['type'] === 'Trailer'){
                array_push($trailer, $video['key']);
            }
        }
        
        $cast = collect($this->detail['credits']['cast'])->map(function($cast){
            $img = is_null($cast['profile_path']) ? (($cast['gender'] == 1) ? asset('img/woman-placeholder.jpg') : asset('img/man-placeholder.jpg')) : config('services.tmdb.img').$cast['profile_path'];

            return collect($cast)->merge([
                'profile_path' => $img,
            ]);
        })->take(5);
        
        return collect($this->detail)->merge([
            'poster_path'   => config('services.tmdb.img').$this->detail['poster_path'],
            'release_year'  => General::release_date($this->detail['release_date']),
            'vote_average'  => $this->detail['vote_average'] * 10 . '%',
            'release_date'  => General::b_date($this->detail['release_date']),
            'genres'        => collect($this->detail['genres'])->pluck('name')->flatten()->implode(', '),
            'runtime'       => $this->detail['runtime'].' minutes',
            'director'      => collect($director)->implode(', '),
            'producer'      => collect($producer)->implode(', '),
            'casters'       => $cast,
            'trailers'      => $trailer,
            'images'        => collect($this->detail['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'vote_average', 'release_date', 'genres', 'title', 
            'overview', 'runtime', 'release_year', 'images', 'director', 
            'producer', 'casters', 'trailers'
        ]);
    }
}