<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\ViewModels\TvShowsViewModel;
use App\ViewModels\TvShowViewModel;

class TvShowsController extends Controller
{
    public function index(){
        $popularTV      = General::callAPI('/tv/popular')['results'];
        $topRatedTV     = General::callAPI('/tv/top_rated')['results'];
        $airingTodayTV  = General::callAPI('/tv/airing_today')['results'];
        $onAirTV        = General::callAPI('/tv/on_the_air')['results'];
        $genreList      = General::callAPI('/genre/tv/list')['genres'];

        $viewModel = new TvShowsViewModel(
            $popularTV,
            $topRatedTV,
            $airingTodayTV,
            $onAirTV,
            $genreList,
        );

        return view('tv.index', $viewModel);
    }
    
    public function show($id){
        $detail = General::callAPI('/tv/'.$id.'?append_to_response=credits,videos,images,recommendations');

        $viewModel = new TvShowViewModel(
            $detail
        );

        return view('tv.show', $viewModel);
    }
}
