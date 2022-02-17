<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\TvShowsController;

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MoviesController::class, 'show'])->name('movies.show');

Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people?page={page?}', [PeopleController::class, 'index']);
Route::get('/people/{name}', [PeopleController::class, 'show'])->name('people.show');

Route::get('/tv-show', [TvShowsController::class, 'index'])->name('tv.index');
Route::get('/tv-show?page={page?}', [TvShowsController::class, 'index']);
Route::get('/tv-show/{show}', [TvShowsController::class, 'show'])->name('tv.show');