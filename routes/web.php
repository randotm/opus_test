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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/upload', 'WordsController@load_to_db_form')->name('upload_form');
Route::post('/upload', 'WordsController@load_to_db');

Route::get('/anagram', 'WordsController@anagram_form')->name('anagram_form');
Route::post('/anagram', 'WordsController@get_anagrams');
Route::post('/anagram_blade', 'WordsController@display_anagrams');
