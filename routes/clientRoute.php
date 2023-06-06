<?php

use App\Role;
use Brick\Math\RoundingMode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// client

Route::get('/', 'ClientIndexController@index');
Route::get('trang-chu', 'ClientIndexController@index')->name('index');
Route::get('lien-he', 'ContactCientController@index');
Route::get('san-pham', 'ClientProductController@index');
Route::get('gioi-thieu', 'ContactCientController@introducing');
Route::get('danh-muc-san-pham/{slug}', 'ClientProductController@product')->name('product_list');
Route::get('blog-cong-nghe', 'ClientPostController@index');
Route::get('bai-viet/{name}', 'ClientPostController@detail');
Route::get('search-product', 'ClientProductController@search_Product')->name('search_product');
Route::get('ajax', 'ClientProductController@ajax')->name('ajax');
Route::get('chi-tiet-san-pham/{slug}', 'ClientProductController@detail');
Route::get('gio-hang.html', 'ClientProductController@cart')->name('cart');
Route::get('them-san-pham/{slug}', 'ClientProductController@addTocart');
Route::get('cart/add', 'ClientProductController@add');
Route::get('cart/delete', 'ClientProductController@delete');
Route::get('cart/destroy', 'ClientProductController@destroy');
Route::post('cart/update', 'ClientProductController@cartUpdate')->name('ajax_shopping_cart');
Route::get('search/product', 'ClientProductController@searchAjax');
Route::post('tim-kiem-san-pham.html', 'ClientProductController@search');
Route::get('dang-nhap.html', 'AuthController@login')->name('login.login');
Route::get('dang-ky.html', 'AuthController@register');
Route::post('post-login', 'AuthController@postLogin');
Route::post('post-register', 'AuthController@postRegister');
Route::get('logout.html', 'AuthController@logoutt');
//email kich hoat tai khoan
Route::get('forget-password', 'AuthController@forgetPass');
Route::post('forgetPassword', 'AuthController@postForgetPass');
Route::get('get-password', 'AuthController@getPass')->name('get.link.reset.password');
Route::post('get-password/', 'AuthController@postGetPass');
// them san pham yeu thich bang ajax
Route::post('add-favorite-products/{id}', 'ClientProductController@addFavoriteProduct')->name('addfavoriteproduct');
Route::get('san-pham-yeu-thich.html', 'ClientProductController@showFavouriteProduct')->name('show_favourite_product');
Route::get('xoa-san-pham-yeu-thich/{id}', 'ClientProductController@deleteFavouriteProduct');
Route::get('thu-hoi-san-pham-yeu-thich/{id}', 'ClientProductController@BackFavouriteProduct');
Route::post('send-contact', 'ContactCientController@send');
Route::get('thanh-toan.html', 'ClientProductController@checkout')->name('checkout');
Route::post('api/fetch-district', 'ClientProductController@fetchState');
Route::post('api/fetch-ward', 'ClientProductController@fetchCity');
Route::post('send-comment','ClientProductController@sendComment')->name('sendComment');
Route::post('don-hang.html','ClientProductController@order')->name('addOrder');
