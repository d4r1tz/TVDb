<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//CREATE
Route::get('/add', [AppController::class, 'create'])->name('seriesAdd');
Route::post('/store', [AppController::class, 'store'])->name('series.store');
Route::get('/addSeasons', [SeasonsController::class, 'create'])->name('seasonsAdd');
Route::post('/storeSeason', [SeasonsController::class, 'store'])->name('seasons.store');
Route::get('/addEpisodes', [EpisodesController::class, 'create'])->name('episodesAdd');
Route::post('/storeEpisode', [EpisodesController::class, 'store'])->name('episodes.store');

//READ
Route::get('/index', [AppController::class, 'index'])->name('seriesIndex');
Route::get('/searchResult', [AppController::class, 'searchPage'])->name('seriesSearch');
Route::get('/seasons',[SeasonsController::class, 'SeasonsOverall'])->name('seasonsOverall');
Route::get('/episodes',[EpisodesController::class, 'EpisodesOverall'])->name('episodesOverall');
Route::get('/viewSeason/{id}',[SeasonsController::class, 'SeasonsSpecific'])->name('seasonsSpecific');
Route::get('/viewEpisodes/{id}',[EpisodesController::class, 'EpisodesSpecific'])->name('episodesSpecific');

//UPDATE
Route::get('/edit/{id}', [AppController::class, 'edit'])->name('seriesEdit');
Route::post('/update/{id}', [AppController::class, 'update'])->name('series.update');
Route::get('/seasonEdit/{id}', [SeasonsController::class, 'edit'])->name('seasonsEdit');
Route::post('/seasonUpdate/{id}', [SeasonsController::class, 'update'])->name('season.update');
Route::get('/episodeEdit/{id}', [EpisodesController::class, 'edit'])->name('episodesEdit');
Route::post('/episodeUpdate/{id}', [EpisodesController::class, 'update'])->name('episode.update');

//DELETE
Route::post('/delete/{id}', [AppController::class, 'delete'])->name('series.delete');
Route::get('/softDel/{id}', [AppController::class, 'softDelete'])->name('seriesSoftDel');
Route::post('/seasonDelete/{id}', [SeasonsController::class, 'delete'])->name('season.delete');
Route::get('/seasonSoftDel/{id}', [SeasonsController::class, 'softDelete'])->name('seasonSoftDel');
Route::post('/episodeDelete/{id}', [EpisodesController::class, 'delete'])->name('episode.delete');
Route::get('/episodeSoftDel/{id}', [EpisodesController::class, 'softDelete'])->name('episodeSoftDel');

//AUTHENTICATION
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', function(){
    \Auth::logout();
    return redirect ('/');
});

//SEARCH DATA
Route::get('/search', [AppController::class, 'search'])->name('seriesSearch');