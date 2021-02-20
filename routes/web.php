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
Route::get('pages/homelist', 'Frontend\PageController@homelist') -> name('pages.home-list');
Route::get('pages/wishlist', 'Frontend\PageController@wishlist') -> name('pages.wish-list');
Route::get('pages/contact', 'Frontend\PageController@contact') -> name('pages.contact');
Route::get('pages/faq', 'Frontend\PageController@FAQ') -> name('pages.faq');
Route::get('pages/about', 'Frontend\PageController@about') -> name('pages.about');
Route::get('pages/checkout', 'Frontend\PageController@checkout') -> name('pages.checkout');
Route::get('pages/cart', 'Frontend\PageController@cart') -> name('pages.cart');
Route::get('pages/single-product', 'Frontend\PageController@singleProduct') -> name('pages.single-product');
Route::post('pages/email-to-contact', 'Frontend\PageController@emailToContact') -> name('pages.email-to-contact');
Route::get('setLocale/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) {
      Session::put('locale', $locale);
    } 
    return redirect()->back();
})->name('app.setLocale');

Route::get('pages/productdetails/{id}', 'Frontend\PageController@singleProduct') -> name('pages.productdetail');

Route::get('/admin', 'Backend\DashboardController@index')->name('admin.dashboard');
Route::get('/admin/calendars', 'Backend\CalendarController@index')->name('admin.calendar.index');
Route::get('/admin/products/print', 'Backend\ProductController@print')->name('admin.products.print');
Route::get('/admin/products/excel', 'Backend\ProductController@excel')->name('admin.products.excel');
Route::get('/admin/products/pdf', 'Backend\ProductController@pdf')->name('admin.products.pdf');
Route::get('/admin/suppliers/print', 'Backend\SupplierController@print')->name('admin.suppliers.print');
Route::get('/admin/suppliers/excel', 'Backend\SupplierController@excel')->name('admin.suppliers.excel');
Route::get('/admin/suppliers/pdf', 'Backend\SupplierController@pdf')->name('admin.suppliers.pdf');
Route::get('/admin/manufactures/print', 'Backend\ManufactureController@print')->name('admin.manufactures.print');
Route::get('/admin/manufactures/excel', 'Backend\ManufactureController@excel')->name('admin.manufactures.excel');
Route::get('/admin/manufactures/pdf', 'Backend\ManufactureController@pdf')->name('admin.manufactures.pdf');
Route::get('/admin/models/print', 'Backend\ModelController@print')->name('admin.models.print');
Route::get('/admin/models/excel', 'Backend\ModelController@excel')->name('admin.models.excel');
Route::get('/admin/models/pdf', 'Backend\ModelController@pdf')->name('admin.models.pdf');

Route::resource('/admin/manufactures', 'Backend\ManufactureController', ['as' => 'admin']);
Route::resource('/admin/suppliers', 'Backend\SupplierController', ['as' => 'admin']);
Route::resource('/admin/models', 'Backend\ModelController', ['as' => 'admin']);
Route::resource('/admin/products', 'Backend\ProductController', ['as' => 'admin']);
Route::resource('/admin/accounts', 'Backend\AccountController', ['as' => 'admin']);
Route::get('/admin/report/orders', 'Backend\ReportController@orders')->name('admin.report.orders');
Route::get('/admin/report/orders/data', 'Backend\ReportController@ordersData')->name('admin.report.orders.data');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
