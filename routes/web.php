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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::middleware('locale')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/subscribe', 'HomeController@addSub')->name('subscribe');
    Route::get('/shop', 'HomeController@viewShop')->name('shop');

    Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');

    Route::get('test-cart', 'CartController@test');

    Auth::routes();
    $this->get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::prefix('product')->group(function () {
        Route::get('/', 'HomeController@detailProduct')->name('product.index');
        Route::post('/quick-view', 'HomeController@viewQuick')->name('product.quick-view');
    });
    Route::get('/check-order', 'CartController@checkOrder')->name('check-order');

    Route::prefix('cart')->middleware('auth:user')->group(function () {
        Route::get('/', 'CartController@index')->name('cart.index');
        Route::post('/update', 'CartController@updateCart')->name('cart.update');
        Route::get('/checkout', 'CartController@checkoutCart')->name('cart.checkout');
        Route::post('/add-order', 'OrderController@store')->name('cart.checkout.add');
        Route::get('/add-cart', 'CartController@addToCart')->name('cart.add');
        Route::get('/add/', 'CartController@add')->name('cart.add.quantity');
        Route::get('/minus/', 'CartController@minus')->name('cart.minus.quantity');
        Route::get('/remove-cart', 'CartController@removeFromCart')->name('cart.delete');
        Route::get('/remove-all-cart', 'CartController@clearAllCart')->name('cart.delete.all');
    });




    Route::middleware('auth:user')->prefix('account')->group(function () {
        Route::get('/', 'UserController@index')->name('user.account');
        Route::get('/addresses', 'UserController@showAddr')->name('user.addresses');
        Route::post('/addresses', 'UserController@changeAddr');
        Route::get('/detail', 'UserController@showDetail')->name('user.detail');
        Route::post('/detail', 'UserController@changeDetail');
        Route::post('/change-info', 'UserController@changeInfo')->name('change-info');
        Route::post('/change-pass', 'UserController@changePassword')->name('change-pass');
    });

    Route::prefix('admin')->middleware('admin.active')->group(function () {
        Route::prefix('crawler')->middleware('operator.permission')->group(function () {
            Route::get('/', 'CrawlerController@index')->name('admin.crawler.index');
            Route::post('/crawl', 'CrawlerController@crawl')->name('admin.crawler.crawl');
            Route::get('/crawl', 'CrawlerController@crawl')->name('admin.crawler.crawl');
            Route::get('/test', 'CrawlerController@testCrawl')->name('admin.crawler.test');
        });
        Route::get('/approve-admin', 'AdminController@showApproveAdmin')->name('admin.up.admin');
        Route::post('/approve-admin', 'AdminController@approveAdmin');
        Route::get('/', 'AdminController@index')->name('admin.dashboard');
        Route::prefix('products')->middleware('auth:admin')->group(function () {
            Route::get('/', 'ProductController@index')->name('admin.products.list');
            Route::get('/images', 'ProductController@listImages')->name('admin.products.images');
            Route::post('/optimize-image', 'ProductController@compressImage')->name('admin.products.optimize');
            Route::post('/optimize-all-image', 'ProductController@compressAllImages')
                ->name('admin.products.optimize.all');
            Route::get('/add', 'ProductController@create')->name('admin.products.add');
            Route::post('/add', 'ProductController@store')->name('admin.products.store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('admin.products.edit');
            Route::post('/edit', 'ProductController@update')->name('admin.products.update');
            Route::post('/remove', 'ProductController@delete')->name('admin.products.remove');
            Route::post('/change-status', 'ProductController@changeShowStatus')->name('admin.products.change_status');
        });

        Route::prefix('categories')->middleware('auth:admin')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.categories.list');
            Route::get('/add', 'CategoryController@create')->name('admin.categories.add');
            Route::post('/add', 'CategoryController@store')->name('admin.categories.store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.categories.edit');
            Route::post('/edit', 'CategoryController@update')->name('admin.categories.update');
            Route::post('/remove', 'CategoryController@delete')->name('admin.categories.remove');
            Route::post('/change-status', 'CategoryController@changeShowStatus')
                ->name('admin.categories.change_status');
        });

        Route::prefix('salers')->middleware('auth:admin')->group(function () {
            Route::get('/', 'SalerController@index')->middleware('operator.permission')->name('admin.salers.list');
//            Route::get('/add','SalerController@create')->name('admin.salers.add');
//            Route::post('/add','SalerController@store')->name('admin.salers.store');
            Route::middleware('change.saler')->group(function () {
                Route::get('/edit/{id}', 'SalerController@edit')->name('admin.salers.edit');
                Route::get('/view/{id}', 'SalerController@view')->name('admin.salers.view');
                Route::post('/edit', 'SalerController@update')->name('admin.salers.update');
                Route::post('/remove', 'SalerController@delete')->name('admin.salers.remove');
                Route::post('/change-status', 'SalerController@changeStatus')->name('admin.salers.change_status');
            });
        });
        Route::prefix('users')->middleware('auth:admin')->group(function () {
            Route::get('/', 'SalerController@showListUser')->name('admin.users.list');

        });

        Route::prefix('orders')->middleware('auth:admin')->group(function () {
            Route::get('/', 'OrderController@index')->name('admin.orders.list');
            Route::get('/view/{id}', 'OrderController@view')->name('admin.orders.view');
            Route::get('/edit/{id}', 'OrderController@edit')->name('admin.orders.edit');
            Route::post('/edit', 'OrderController@update')->name('admin.orders.update');
            Route::post('/remove', 'OrderController@delete')->name('admin.orders.remove');
        });
        Route::prefix('shippers')->middleware('auth:admin', 'operator.permission')->group(function () {
            Route::get('/', 'ShipperController@index')->name('admin.shippers.list');
            Route::get('/add', 'ShipperController@create')->name('admin.shippers.add');
            Route::post('/add', 'ShipperController@store')->name('admin.shippers.store');
            Route::get('/edit/{id}', 'ShipperController@edit')->name('admin.shippers.edit');
            Route::post('/edit', 'ShipperController@update')->name('admin.shippers.update');
            Route::post('/remove', 'ShipperController@delete')->name('admin.shippers.remove');
        });
        Route::prefix('payments')->middleware('auth:admin', 'operator.permission')->group(function () {
            Route::get('/', 'PaymentController@index')->name('admin.payments.list');
            Route::get('/add', 'PaymentController@create')->name('admin.payments.add');
            Route::post('/add', 'PaymentController@store')->name('admin.payments.store');
            Route::get('/edit/{id}', 'PaymentController@edit')->name('admin.payments.edit');
            Route::post('/edit', 'PaymentController@update')->name('admin.payments.update');
            Route::post('/remove', 'PaymentController@delete')->name('admin.payments.remove');
        });

        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.post');
        Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
        Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.post');
        Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    });
});
