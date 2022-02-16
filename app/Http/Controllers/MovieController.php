<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;

class MovieController extends Controller
{
    private function callAPI($url){
        return Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.url').$url)
                    ->json();
    }

    public function index(){
        $popularMovies      = $this->callAPI('/movie/popular')['results'];
        $nowPlayingMovies   = $this->callAPI('/movie/now_playing')['results'];
        $genreList          = $this->callAPI('/genre/movie/list')['genres'];

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genreList,
        );

        return view('index', $viewModel);
    }
    
    public function show($id){
        $detail = $this->callAPI('/movie/'.$id.'?append_to_response=credits,videos,images');

        $viewModel = new MovieViewModel(
            $detail
        );

        return view('show', $viewModel);
    }
}
