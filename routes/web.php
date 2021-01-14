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

Route::get('/', 'Frontend\PageController@index') -> name('pages.home');
Route::get('pages/home_list', 'Frontend\PageController@home_list') -> name('pages.home_list');
Route::get('pages/wish_list', 'Frontend\PageController@wish_list') -> name('pages.wish_list');
Route::get('pages/contact', 'Frontend\PageController@contact') -> name('pages.contact');
Route::get('pages/faq', 'Frontend\PageController@FAQ') -> name('pages.faq');
Route::get('pages/about', 'Frontend\PageController@about') -> name('pages.about');
Route::post('pages/email_to_contact', 'Frontend\PageController@email_to_contact') -> name('pages.email_to_contact');
