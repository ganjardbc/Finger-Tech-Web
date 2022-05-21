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

//web
Route::get('*', function () {
    return view('404', [
        'title' => '404 Not Found',
        'path' => 'none'
    ]);
});

Route::get('/', 'WebController@index');
Route::get('/instagram', 'WebController@instagram');
Route::get('/search', 'WebController@search');

//service
Route::get('/services', 'ServiceController@list');
Route::get('/service/{id}', 'ServiceController@view');

//banner
Route::get('/products', 'BannerController@list');
Route::get('/product/{id}', 'BannerController@view');

//article
Route::get('/articles', 'ArticleController@list');
Route::get('/article/{id}', 'ArticleController@view');

//galery
Route::get('/portofolios', 'GaleryController@list');
Route::get('/portofolio/{id}', 'GaleryController@view');
Route::get('/portofolios/tags/{tag}', 'GaleryController@tags');

//banner

//sites
Route::get('/profile', 'WebController@aboutUs');
Route::get('/contacts', 'WebController@contacts');
Route::get('/sites/terms-n-conditions', 'WebController@tnc');
Route::get('/sites/privacy', 'WebController@privacy');
Route::get('/sites/faq', 'WebController@faq');

// contact
Route::post('/contact/publish', 'ContactController@publish');

//admin
//Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

//private
Route::middleware('auth')->group(function() {
    Route::get('/home', 'WebController@admin');
});

Route::middleware('auth')->prefix('admin')->group(function() {
    
    Route::get('/', 'WebController@admin');

    //banner
    Route::get('/product', 'BannerController@index');
    Route::get('/product/create', 'BannerController@create');
    Route::get('/product/edit/{id}', 'BannerController@edit');
    Route::post('/banner/publish', 'BannerController@publish');
    Route::post('/banner/put', 'BannerController@put');
    Route::post('/banner/remove', 'BannerController@remove');
    Route::post('/banner/changePosition', 'BannerController@changePosition');

    //service
    Route::get('/service', 'ServiceController@index');
    Route::get('/service/create', 'ServiceController@create');
    Route::get('/service/edit/{id}', 'ServiceController@edit');
    Route::post('/service/publish', 'ServiceController@publish');
    Route::post('/service/put', 'ServiceController@put');
    Route::post('/service/remove', 'ServiceController@remove');

    //article
    Route::get('/article', 'ArticleController@index');
    Route::get('/article/create', 'ArticleController@create');
    Route::get('/article/edit/{id}', 'ArticleController@edit');
    Route::post('/article/publish', 'ArticleController@publish');
    Route::post('/article/put', 'ArticleController@put');
    Route::post('/article/remove', 'ArticleController@remove');

    //draft
    Route::post('/article/changePinned', 'ArticleController@changePinned');
    Route::post('/article/changeDraft', 'ArticleController@changeDraft');

    //galery
    Route::get('/portofolio', 'GaleryController@index');
    Route::get('/portofolio/create', 'GaleryController@create');
    Route::get('/portofolio/edit/{id}', 'GaleryController@edit');
    Route::post('/galery/publish', 'GaleryController@publish');
    Route::post('/galery/put', 'GaleryController@put');
    Route::post('/galery/remove', 'GaleryController@remove');

    //note
    Route::get('/client', 'NoteController@index');
    Route::get('/client/create', 'NoteController@create');
    Route::get('/client/edit/{id}', 'NoteController@edit');
    Route::post('/note/publish', 'NoteController@publish');
    Route::post('/note/put', 'NoteController@put');
    Route::post('/note/remove', 'NoteController@remove');

    //testimony
    Route::get('/testimony', 'TestimonyController@index');
    Route::get('/testimony/create', 'TestimonyController@create');
    Route::get('/testimony/edit/{id}', 'TestimonyController@edit');
    Route::post('/testimony/publish', 'TestimonyController@publish');
    Route::post('/testimony/put', 'TestimonyController@put');
    Route::post('/testimony/remove', 'TestimonyController@remove');

    //contact
    Route::get('/contact', 'ContactController@index');
    Route::get('/contact/create', 'ContactController@create');
    Route::get('/contact/edit/{id}', 'ContactController@edit');
    Route::post('/contact/publish', 'ContactController@publish');
    Route::post('/contact/put', 'ContactController@put');
    Route::post('/contact/remove', 'ContactController@remove');

    //admin
    Route::get('/admin', 'AdminController@index')->name('listAdmin');
    Route::get('/admin/create', 'AdminController@create')->name('createAdmin');
    Route::get('/admin/edit', 'AdminController@edit');
    Route::get('/admin/password', 'AdminController@password');
    Route::post('/admin/publish', 'AdminController@publish');
    Route::post('/admin/photo', 'AdminController@photo');
    Route::post('/admin/put', 'AdminController@put');
    Route::post('/admin/password', 'AdminController@password');
    Route::post('/admin/remove', 'AdminController@remove');

    //pin
    Route::post('/pin/add', 'PinController@add');
    Route::post('/pin/remove', 'PinController@remove');

    //images
    Route::get('/images', 'ImagesController@index');
    Route::get('/images/create/{idowner}/{type}', 'ImagesController@create');
    Route::get('/images/edit/{idowner}/{id}', 'ImagesController@edit');
    Route::post('/images/publish', 'ImagesController@publish');
    Route::post('/images/put', 'ImagesController@put');
    Route::post('/images/remove', 'ImagesController@remove');
});