<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RecentController;
use App\Http\Controllers\ArtisteController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TitreController;

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

Route::get('/', [HomeController::class, 'showHomepage'])->middleware(['auth'])->name('home');
Route::get('/search', [SearchController::class, 'index']);
Route::get('/autocomplete-search', [SearchController::class, 'autocompleteSearch']);

Route::get('/artiste/{artiste}', [ArtisteController::class, 'show'])->name('artiste');
Route::post('/artiste/{artiste}', [ArtisteController::class, 'like'])->name('likeArtiste');

Route::get('/album/{album}', [AlbumController::class, 'show'])->name('album');
Route::post('/album/{album}', [AlbumController::class, 'like'])->name('like');

Route::get('/genres', [GenreController::class, 'index'])->name('genres');
Route::get('/genre/{genre}', [GenreController::class, 'show'])->name('genre');

Route::get('/player/{album}', [PlayerController::class, 'show'])->name('player');
Route::post('/player/{album}', [PlayerController::class, 'like'])->name('likePlayer');

Route::resource('recent', RecentController::class);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/forgotPwd', [PasswordResetLinkController::class, 'create'])->name('forgotPwd');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('getlogout');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
