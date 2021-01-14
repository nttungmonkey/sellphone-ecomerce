<?php

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
    return view('frontend.index');
});
Route::get('pages/contact', 'Frontend\PageController@contact') -> name('pages.contact');
Route::get('pages/faq', 'Frontend\PageController@FAQ') -> name('pages.faq');
Route::get('pages/about', 'Frontend\PageController@about') -> name('pages.about');
Route::post('pages/email_to_contact', 'Frontend\PageController@email_to_contact') -> name('pages.email_to_contact');
