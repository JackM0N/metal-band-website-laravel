<?php

use App\Http\Controllers\ConcertController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SongController;
use App\Http\Livewire\Albums\AlbumGridView;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::name('users.')->prefix('users')->group(function () {
        Route::get('',[UserController::class,'index'])
        ->name('index')
        ->middleware(['permission:users.index']);
    });

    Route::resource('albums', AlbumController::class)->only([
        'index', 'create', 'edit'
    ]);
    Route::resource('tours', TourController::class)->only([
        'index', 'create', 'edit'
    ]);
    Route::resource('news', NewsController::class)->only([
        'index', 'create', 'edit'
    ]);
    Route::resource('songs', SongController::class)->only([
        'index', 'create', 'edit'
    ]);
    Route::resource('concerts', ConcertController::class)->only([
        'index', 'create', 'edit'
    ]);

    Route::get('async/tours', [TourController::class, 'async'])->name('async.tours');
    Route::get('async/albums', [AlbumController::class, 'async'])->name('async.albums');
    Route::get('albums/{album}', [SongController::class, 'songsForAlbum'])->name('albums.songs');
    Route::get('tours/{tour}', [ConcertController::class, 'concertsForTour'])->name('tours.concerts');
});
