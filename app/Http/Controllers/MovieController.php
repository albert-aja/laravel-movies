<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\General;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.url').'/movie/popular')
                            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
                                ->get(config('services.tmdb.url').'/movie/now_playing')
                                ->json()['results'];

        return view('index', [
            'popularMovies'     => $popularMovies,
            'nowPlayingMovies'  => $nowPlayingMovies,
            'genreList'         => General::genre_convert(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.url').'/movie/'.$id.'?append_to_response=credits,videos,images')
                    ->json();

        return view('show', [
            'detail'    => $detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
