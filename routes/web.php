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

Route::get('/my_borrows',function (){
    $borrow=\App\Models\Borrow::all()->where('reader_id','===',auth()->id());
    $pbook=$borrow->where('status','===','PENDING');
    $abook=$borrow->where('status','===','ACCEPTED')->where('deadline','>',now());
    $lbook=$borrow->where('status','===','ACCEPTED')->where('deadline','<',now());
    $rbook=$borrow->where('status','===','REJECTED');
    $rtbook=$borrow->where('status','===','RETURNED');
    return view('borrows.my_borrows',[
        'pending'=>$pbook,
        'inTime'=>$abook,
        'late'=>$lbook,
        'rejected'=>$rbook,
        'returned'=>$rtbook,
    ]);
})->middleware('auth');
Route::resource('borrows',\App\Http\Controllers\BorrowController::class)->middleware('auth');
