<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use App\Helpers\General;

class MoviesController extends Controller
{
    public function index(){
        $popularMovies      = General::callAPI('/movie/popular')['results'];
        $nowPlayingMovies   = General::callAPI('/movie/now_playing')['results'];
        $upcomingMovies     = General::callAPI('/movie/upcoming?region=US')['results'];
        $topRatedMovies     = General::callAPI('/movie/top_rated')['results'];
        $genreList          = General::callAPI('/genre/movie/list')['genres'];

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $upcomingMovies,
            $topRatedMovies,
            $genreList,
        );

        return view('movies.index', $viewModel);
    }
    
    public function show($id){
        $detail = General::callAPI('/movie/'.$id.'?append_to_response=credits,videos,images');

        $viewModel = new MovieViewModel(
            $detail
        );

        return view('movies.show', $viewModel);
    }
}
