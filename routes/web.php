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
Route::get('/login', 'Frontend\PageController@login') -> name('pages.login');
Route::get('pages/homelist', 'Frontend\PageController@homelist') -> name('pages.home-list');
Route::get('pages/wishlist', 'Frontend\PageController@wishlist') -> name('pages.wish-list');
Route::get('pages/contact', 'Frontend\PageController@contact') -> name('pages.contact');
Route::get('pages/faq', 'Frontend\PageController@FAQ') -> name('pages.faq');
Route::get('pages/about', 'Frontend\PageController@about') -> name('pages.about');
Route::get('pages/checkout', 'Frontend\PageController@checkout') -> name('pages.checkout');
Route::get('pages/cart', 'Frontend\PageController@cart') -> name('pages.cart');
Route::get('pages/single-product', 'Frontend\PageController@singleProduct') -> name('pages.single-product');
Route::post('pages/email-to-contact', 'Frontend\PageController@emailToContact') -> name('pages.email-to-contact');
