<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PeopleController;

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people/{name}', [PeopleController::class, 'show'])->name('poeple.show');