<?php

use App\Customer;
use App\Order;
use Brick\Math\RoundingMode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/admin', 'AdminController@loginAdmin');
// Route::post('/admin', 'AdminController@checkLogin');

# link admin
// 'middleware' => 'can:home-list'
Route::middleware('auth')->group(function () {
    Route::get('/comment', [
        'as' => 'comment.index',
        'uses' => 'AdminCommentController@index',
        'middleware' => 'can:comment-list'
    ]);
    Route::get('delete-comment/{id}', 'AdminCommentController@delete');
    Route::get('comment-detail/{id}', 'AdminCommentController@detailComment');
    Route::post('reply-comment', 'AdminCommentController@replyComment');
    Route::get('action/{id}', 'AdminCommentController@action');
    Route::get('wating/{id}', 'AdminCommentController@wating');
    Route::get('/home', [
        'as' => 'home.index',
        'uses' => 'HomeController@home',
        'middleware' => 'can:admin-list'
    ]);
    Route::prefix('admin')->group(function () {
        Route::prefix('categories')->group(function () {
            Route::get('/create', [
                // đường link route vd: name('categories.create);
                'as' => 'categories.create',
                // controller xử lý
                'uses' => 'CategoryController@create',
                'middleware' => 'can:category-add'
            ]);
            Route::post('/add', [
                // đường link route vd: name('categories.create);
                'as' => 'categories.add',
                // controller xử lý
                'uses' => 'CategoryController@add',
            ]);
            Route::get('/edit-cat/{id}', [
                // đường link route vd: name('categories.create);
                'as' => 'categories.edt_cat',
                // controller xử lý
                'uses' => 'CategoryController@edt_cat',
            ]);
            Route::post('/update-cat/{id}', [
                // đường link route vd: name('categories.create);
                'as' => 'categories.update_cat',
                // controller xử lý
                'uses' => 'CategoryController@update_cat',
                'middleware' => 'can:category-edit'
            ]);
            Route::get('/delete-cat/{id}', [
                // đường link route vd: name('categories.create);
                'as' => 'categories.delete_cat',
                // controller xử lý
                'uses' => 'CategoryController@delete_cat',
                'middleware' => 'can:category-delete'
            ]);
            Route::get('/action-cat', [
                // đường link route vd: name('categories.create);
                'as' => 'categories.action',
                // controller xử lý
                'uses' => 'CategoryController@action_cat'
            ]);
            Route::get('/', [
                'as' => 'categories.index',
                // controller xử lý
                'uses' => 'CategoryController@index',
                'middleware' => 'can:category-list'
            ]);
        });
        Route::get('/error', 'AdminController@error')->name('errors.403');
        Route::prefix('pages')->group(function () {
            Route::get('/contacts', [
                'as' => 'contacts.index',
                'uses' => 'PageController@index',
                'middleware' => 'can:page-list'
            ]);
            Route::get('/contact-us/{id}', [
                'as' => 'contact-us.index_contact_us',
                'uses' => 'PageController@index_contact_us'
            ]);
            Route::post('sendmail', 'PageController@sendmail')->name('sendmail');
        });
        //     Route::pot('sendmail','PageController@sendmail');
        Route::prefix('products')->group(function () {
            Route::get('/index', [
                'as' => 'products.index',
                'uses' => 'AdminProductController@index',
                'middleware' => 'can:product-list'
            ]);
            Route::get('/add', [
                'as' => 'products.add',
                'uses' => 'AdminProductController@add',
                'middleware' => 'can:product-add'
            ]);
            Route::post('/add-new', [
                'as' => 'products.addnew',
                'uses' => 'AdminProductController@add_new',
                'middleware' => 'can:product-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'products.edit',
                'uses' => 'AdminProductController@edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'products.update',
                'uses' => 'AdminProductController@update',
                'middleware' => 'can:product-edit'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'products.delete',
                'uses' => 'AdminProductController@delete',
                'middleware' => 'can:product-delete'
            ]);
            Route::get('/product/action', [
                'as' => 'posts.actionproduct',
                'uses' => 'AdminProductController@action_product'
            ]);
        });
        Route::prefix('orders')->group(function () {
            Route::get('/index', [
                'as' => 'order.index',
                'uses' => 'OrderController@index',
                'middleware' => 'can:order-list'
            ]);
            Route::get('/detail/{id}', [
                'as' => 'order.detail',
                'uses' => 'OrderController@detail'
            ]);
            Route::get('/action', [
                'as' => 'order.action',
                'uses' => 'OrderController@action'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'order.delete',
                'uses' => 'OrderController@delete'
            ]);
        });
        Route::prefix('menus')->group(function () {
            Route::get('/index', [
                'as' => 'menu.index',
                'uses' => 'MenuController@index',
                'middleware' => 'can:menu-list'
            ]);
            Route::post('/add', [
                'as' => 'menu.add',
                'uses' => 'MenuController@add',
                'middleware' => 'can:menu-add'
            ]);
            Route::get('/create', [
                'as' => 'menu.create',
                'uses' => 'MenuController@create',
                'middleware' => 'can:menu-add'
            ]);
            Route::get('/action', [
                'as' => 'menu.action',
                'uses' => 'MenuController@action'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'menu.edit',
                'uses' => 'MenuController@edit',
            ]);
            Route::get('/delete/{id}', [
                'as' => 'menu.delete',
                'uses' => 'MenuController@delete',
                'middleware' => 'can:menu-delete'
            ]);
            Route::post('/update/{id}', [
                'as' => 'menu.update',
                'uses' => 'MenuController@update',
                'middleware' => 'can:menu-edit'
            ]);
        });
        Route::prefix('posts')->group(function () {
            Route::get('/add', [
                'as' => 'posts.add',
                'uses' => 'AdminPostController@add',
                'middleware' => 'can:post-add'
            ]);
            Route::post('/create', [
                'as' => 'posts.create',
                'uses' => 'AdminPostController@create',
                'middleware' => 'can:post-add'
            ]);
            Route::get('/index', [
                'as' => 'posts.index',
                'uses' => 'AdminPostController@index',
                'middleware' => 'can:menu-list'
            ]);
            Route::get('/list-cat', [
                'as' => 'posts.indexcategory',
                'uses' => 'AdminPostController@indexcategory',
                'middleware' => 'can:category-list'
            ]);
            Route::post('/store-cat', [
                'as' => 'posts.store',
                'uses' => 'AdminPostController@store',
                'middleware' => 'can:category-add'
            ]);
            Route::get('/action-cat', [
                'as' => 'posts.action',
                'uses' => 'AdminPostController@action'
            ]);
            Route::get('/edit-cat/{id}', [
                'as' => 'postscat.edit',
                'uses' => 'AdminPostController@editcat'
            ]);
            Route::get('/delete-cat/{id}', [
                'as' => 'postscat.delete',
                'uses' => 'AdminPostController@deletecat',
                'middleware' => 'can:category-delete'
            ]);
            Route::post('update/cat/post/{id}', [
                'as' => 'posts.update_cat',
                'uses' => 'AdminPostController@updatecat',
                'middleware' => 'can:category-edit'
            ]);
            Route::get('edit/posts/{id}', [
                'as' => 'posts.edit',
                'uses' => 'AdminPostController@edit_post'
            ]);
            Route::post('update/posts/{id}', [
                'as' => 'posts.update',
                'uses' => 'AdminPostController@update_post',
                'middleware' => 'can:post-edit'
            ]);
            Route::get('delete/posts/{id}', [
                'as' => 'posts.delete',
                'uses' => 'AdminPostController@delete_post',
                'middleware' => 'can:post-edit'
            ]);
            Route::get('action/posts/', [
                'as' => 'posts.actionposts',
                'uses' => 'AdminPostController@action_posts'
            ]);
        });
        Route::prefix('sliders')->group(function () {
            Route::get('/index', [
                'as' => 'slider.index',
                'uses' => 'AdminSliderController@index',
                'middleware' => 'can:slider-list'
            ]);
            Route::get('/create', [
                'as' => 'slider.create',
                'uses' => 'AdminSliderController@create',
                'middleware' => 'can:slider-add'
            ]);
            Route::post('/store', [
                'as' => 'slider.store',
                'uses' => 'AdminSliderController@store',
                'middleware' => 'can:slider-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'slider.edit',
                'uses' => 'AdminSliderController@edit',
                'middleware' => 'can:slider-edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'slider.update',
                'uses' => 'AdminSliderController@update',
                'middleware' => 'can:slider-edit'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'slider.delete',
                'uses' => 'AdminSliderController@delete',
                'middleware' => 'can:slider-delete'
            ]);
            Route::get('/action', [
                'as' => 'slider.action',
                'uses' => 'AdminSliderController@action',
            ]);
        });
        Route::prefix('settings')->group(function () {
            Route::get('/index', [
                'as' => 'setting.index',
                'uses' => 'AdminSettingController@index',
                'middleware' => 'can:setting-list'
            ]);
            Route::get('/add', [
                'as' => 'setting.add',
                'uses' => 'AdminSettingController@add',
                'middleware' => 'can:setting-add'
            ]);
            Route::post('/store', [
                'as' => 'setting.store',
                'uses' => 'AdminSettingController@store',
                'middleware' => 'can:setting-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'setting.edit',
                'uses' => 'AdminSettingController@edit',
                'middleware' => 'can:setting-edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'setting.update',
                'uses' => 'AdminSettingController@update',
                'middleware' => 'can:setting-edit'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'setting.delete',
                'uses' => 'AdminSettingController@delete',
                'middleware' => 'can:setting-delete'
            ]);
        });
        Route::prefix('users')->group(function () {
            Route::get('/index', [
                'as' => 'users.index',
                'uses' => 'AdminUserController@index',
                'middleware' => 'can:user-list'
            ]);
            Route::get('/add', [
                'as' => 'users.add',
                'uses' => 'AdminUserController@add',
                'middleware' => 'can:user-add'
            ]);
            Route::post('/store', [
                'as' => 'users.store',
                'uses' => 'AdminUserController@store',
                'middleware' => 'can:user-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'users.edit',
                'uses' => 'AdminUserController@edit',
                'middleware' => 'can:user-edit'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'users.delete',
                'uses' => 'AdminUserController@delete',
                'middleware' => 'can:user-delete'
            ]);
            Route::post('/update/{id}', [
                'as' => 'users.update',
                'uses' => 'AdminUserController@update',
                'middleware' => 'can:user-edit'
            ]);
            Route::get('/action', [
                'as' => 'users.action',
                'uses' => 'AdminUserController@action'
            ]);
        });
        Route::prefix('roles')->group(function () {
            Route::get('/index', [
                'as' => 'roles.index',
                'uses' => 'AdminRoleController@index',
                'middleware' => 'can:role-list'
            ]);
            Route::get('/add', [
                'as' => 'roles.add',
                'uses' => 'AdminRoleController@add',
                'middleware' => 'can:role-add'
            ]);
            Route::post('/store', [
                'as' => 'roles.store',
                'uses' => 'AdminRoleController@store',
                'middleware' => 'can:role-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'roles.edit',
                'uses' => 'AdminRoleController@edit',
                'middleware' => 'can:role-edit'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'roles.delete',
                'uses' => 'AdminRoleController@delete',
                'middleware' => 'can:role-delete'
            ]);
            Route::post('/update/{id}', [
                'as' => 'roles.update',
                'uses' => 'AdminRoleController@update',
                'middleware' => 'can:role-edit'
            ]);
        });
        Route::prefix('permission')->group(function () {
            Route::get('/create', [
                'as' => 'permission.create',
                'uses' => 'AdminPermissionController@createPermission',
                'middleware' => 'can:permissions-list'
            ]);
            Route::post('/store', [
                'as' => 'permission.store',
                'uses' => 'AdminPermissionController@storePermission'
            ]);
        });
    });
});
Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
