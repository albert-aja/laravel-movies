<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class PeopleViewModel extends ViewModel
{
    public $people;
    public $page;
    
    public function __construct($people, $page){
        $this->people   = $people;
        $this->page     = $page;
        $this->maxPage  = 500;
        $this->maxText  = 50;
    }

    public function people(){
        return collect($this->people)->map(function($person){
            $profile = is_null($person['profile_path']) ? (($person['gender'] == 1) ? asset('img/woman-placeholder-head.jpg') : asset('img/man-placeholder-head.jpg')) : config('services.tmdb.people_img').$person['profile_path'];

            $known_for = collect($person['known_for'])->where('media_type', 'movie')->pluck('title')->union(collect($person['known_for'])->where('media_type', 'tv')->pluck('name'))->implode(', ');

            return collect($person)->merge([
                'profile_path'  => $profile,
                'known_for'     => (strlen($known_for) <= $this->maxText) ? $known_for : substr($known_for, 0, $this->maxText) . '...'
                ,
            ])->only([
                'profile_path', 'known_for', 'name', 'id'
            ]);
        });
    }

    public function previous(){
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next(){
        return $this->page < $this->maxPage ? $this->page + 1 : null;
    }
}
