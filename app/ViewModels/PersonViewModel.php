<?php

namespace App\ViewModels;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class PersonViewModel extends ViewModel
{
    public $detail;
    
    public function __construct($detail){
        $this->detail = $detail;
        $this->department = [
            'Acting'    => 'Actor', 
            'Writing'   => 'Writer', 
            'Directing' => 'Director'
        ];
    }

    public function detail(){
        $profile = is_null($this->detail['profile_path']) ? (($this->detail['gender'] == 1) ? asset('img/woman-placeholder.jpg') : asset('img/man-placeholder.jpg')) : config('services.tmdb.img').$this->detail['profile_path'];

        $gender = ($this->detail['gender'] == 1) ? '<i class="fa-solid fa-venus mr-1 text-gray-600"></i> Female' : '<i class="fa-solid fa-mars mr-1 text-gray-600"></i> Male';

        $social = [
            'facebook'  => ($this->detail['external_ids']['facebook_id'])
                            ? 'https://www.facebook.com/' . $this->detail['external_ids']['facebook_id'] : null,
            'twitter'   => ($this->detail['external_ids']['twitter_id'])
                            ? 'https://twitter.com/' . $this->detail['external_ids']['twitter_id'] : null,
            'instagram' => ($this->detail['external_ids']['instagram_id']) 
                            ? 'https://www.instagram.com/' . $this->detail['external_ids']['instagram_id'] : null,
        ];

        $known_for = collect($this->detail['combined_credits']['cast'])->sortByDesc(('popularity'))->take(7)->map(function($cast){
            if(isset($cast['title'])){
                $title = $cast['title'];
            } else if (isset($cast['name'])){
                $title = $cast['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($cast)->merge([
                'poster_path'   => ($cast['poster_path']) ? config('services.tmdb.img').$cast['poster_path'] 
                                    : asset('img/movie-poster-placeholder.png'),
                'title'         => $title
            ])->only(['id', 'poster_path', 'title']);
        });

        $images = collect($this->detail['images']['profiles'])->take(10)->map(function($image){
            return collect($image)->merge([
                'file_path' => config('services.tmdb.img').$image['file_path'],
            ])->only(['file_path']);
        });
        
        return collect($this->detail)->merge([
            'known_for_department'  => $this->department[$this->detail['known_for_department']] ??          
                                        $this->detail['known_for_department'],
            'biography'             => (!empty($this->detail['biography'])) 
                                        ? $this->detail['biography'] : 'Biography for ' .$this->detail['name']. ' not found.',
            'profile_path'          => $profile,
            'birthday'              => ($this->detail['birthday']) 
                                        ? General::b_date($this->detail['birthday']) : $this->detail['birthday'],
            'age'                   => General::get_age($this->detail['birthday']).' years old',
            'gender'                => $gender,
            'social'                => $social,
            'known_for'             => $known_for,
            'images'                => $images,
        ]);
    }
}
