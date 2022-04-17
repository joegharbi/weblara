<?php

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

Route::get('/', function () {
    $numUsers=\App\Models\User::all()->where('is_librarian','=','0')->count();
    $numGenres=\App\Models\Genre::count();
    $numBooks=\App\Models\Book::count();
    $numActRent= \App\Models\Borrow::all()->where('status', '=', 'ACCEPTED')->count();
    $listGenre=\App\Models\Genre::all();

    return view('welcome',[
        'numUsers'=>$numUsers,
        'numGenres'=>$numGenres,
        'numBooks'=>$numBooks,
        'numActRent'=>$numActRent,
        'listGenre'=>$listGenre
    ]);


});
Route::resource('books',\App\Http\Controllers\BookController::class)->middleware('auth');
Route::resource('genres', \App\Http\Controllers\GenreController::class);
Route::resource('genres.books', \App\Http\Controllers\BookController::class)->shallow();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('borrows',\App\Http\Controllers\BorrowController::class)->middleware('auth');
Route::get('/profile',function (){
    $user=auth()->user();
    return view('profile',['user'=>$user]);
    })
    ->name('profile')->middleware('auth');
