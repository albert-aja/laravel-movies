<?php

namespace App\ViewModels;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $detail;
    
    public function __construct($detail){
        $this->detail = $detail;
    }

    public function detail(){
        $trailer = [];

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
        });

        if(!empty($this->detail['images']['backdrops'])){
            $images = collect($this->detail['images']['backdrops'])->take(9);
        } else if (!empty($this->detail['images']['posters'])){
            $images = collect($this->detail['images']['posters'])->take(4);
        } else {
            $images = $this->detail['images']['logos'][0];
        }

        $networks = collect($this->detail['networks'])->map(function($network){
            return collect($network)->merge([
                'logo_path' => config('services.tmdb.img').$network['logo_path']
            ])->only(['name', 'logo_path']);
        });
        
        $recommendations = collect($this->detail['recommendations']['results'])->take(7)->map(function($recom){
            return collect($recom)->merge([
                'poster_path' => ($recom['poster_path']) 
                                ? config('services.tmdb.img').$recom['poster_path'] : asset('img/movie-poster-placeholder.png'),
            ])->only(['poster_path', 'name', 'vote_average', 'id']);
        });

        return collect($this->detail)->merge([
            'poster_path'       => ($this->detail['poster_path']) 
                                    ? config('services.tmdb.img').$this->detail['poster_path'] : asset('img/movie-poster-placeholder.png'),
            'overview'          => (!empty($this->detail['overview']))
                                    ? $this->detail['overview']:  "No overview translated in English found.",
            'backdrop_path'     => config('services.tmdb.backdrop').$this->detail['backdrop_path'],
            'release_year'      => General::get_year($this->detail['first_air_date']),
            'vote_average'      => ($this->detail['vote_average'] > 0) 
                                    ? ($this->detail['vote_average'] * 10 . '%') : 'N/A',
            'first_air_date'    => General::b_date($this->detail['first_air_date']),
            'genres'            => collect($this->detail['genres'])->pluck('name')->flatten()->implode(', '),
            'episode_run_time'  => $this->detail['episode_run_time'][0].' minutes',
            'networks'          => (!empty($this->detail['networks'])) ? $networks : null,
            'casters'           => $cast,
            'trailers'          => $trailer,
            'images'            => $images,
            'caster_total'      => count($this->detail['credits']['cast']),
            'recommendations'   => $recommendations,
        ])->only([
            'poster_path', 'vote_average', 'first_air_date', 'genres', 'name', 
            'overview', 'episode_run_time', 'release_year', 'images', 'casters',
            'trailers', 'created_by', 'number_of_seasons', 'networks',
            'number_of_episodes', 'networks', 'backdrop_path', 'caster_total',
            'recommendations',
        ]);
    }
}
