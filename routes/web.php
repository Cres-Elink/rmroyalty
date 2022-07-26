<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthenticationController::class)->group(function(){
        Route::get('/login','index')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');
    });
});

Route::middleware('auth')->group(function(){

    Route::get('/home', function(){
        return redirect(route('dashboard'));
    });

    Route::controller(AuthenticationController::class)->group(function(){
        Route::get('/', 'dashboard')->name('dashboard');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(AuthorController::class)->group(function(){
        Route::get('/authors', 'index')->name('author.index');
        Route::get('/authors/import', 'importPage')->name('author.import-page');
        Route::post('/authors/import', 'import')->name('author.import-bulk');
        Route::get('/authors/create', 'create')->name('author.create');
        Route::get('/authors/{author}', 'edit')->name('author.edit');
        Route::post('/authors/create', 'store')->name('author.store');
        Route::put('/authors/{author}', 'update')->name('author.update');
        Route::delete('/authors/{author}', 'delete')->name('author.delete');
    });

    Route::controller(BookController::class)->group(function(){
        Route::get('/books','index')->name('book.index');
        Route::get('/books/import','importPage')->name('book.import-page');
        Route::post('/books/import', 'import')->name('book.import-bulk');
        Route::get('/books/create', 'create')->name('book.create');
        Route::get('/books/{book}', 'edit')->name('book.edit');
        Route::post('/books/create', 'store')->name('book.store');
        Route::put('/books/{book}', 'update')->name('book.update');
        Route::delete('/books/{book}', 'delete')->name('book.delete');
    });
});