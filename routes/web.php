<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideController;
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

Route::get('home',[PageController::class, 'index'])
->name('trangchu');

Route::get('producttype/{type}',[PageController::class, 'producttype'])
->name('loaisanpham');

Route::get('productdetail/{id}',[PageController::class, 'productdetail'])
->name('chitietsanpham');

Route::get('contact',[PageController::class, 'Contact'])
->name('lienhe');

Route::get('about',[PageController::class, 'About'])
->name('gioithieu');

Route::get('add-to-cart/{id}',[PageController::class, 'getAddToCart'])
->name('themgiohang');

Route::get('del-to-cart/{id}',[PageController::class, 'getDelCart'])
->name('xoagiohang');

Route::get('dat-hang',[PageController::class, 'getCheckout'])
->name('dathang');
Route::post('dat-hang',[PageController::class, 'postCheckout'])
->name('dathang2');

Route::get('search',[PageController::class, 'Search'])
->name('timkiem');

Route::get('/signup',[PageController::class,'getSignup'])->name('getSignup');
Route::post('/signup',[PageController::class,'postSignup'])->name('postSignup');

Route::get('/login',[PageController::class,'getLogin'])->name('getLogin');
Route::post('/login',[PageController::class,'postLogin'])->name('postLogin');

Route::get('/logout',[PageController::class,'getLogout'])->name('logout');

Route::get('/administrator',function(){
        return view('admin.layout.master');
        });

Route::get('/register',[UserController::class,'getSignupadmin'])->name('getSignupadmin');
Route::post('/register',[UserController::class,'postSignupadmin'])->name('postSignupadmin');

Route::get('/loginadmin',[UserController::class,'getLoginadmin'])->name('getLoginadmin');
Route::post('/loginadmin',[UserController::class,'postLoginadmin'])->name('postLoginadmin');

Route::resource('users',UserController::class);

Route::get('/users/{id}/edit',[UserController::class, 'edit']);
Route::get('/user-detail/{id}',[UserController::class, 'show']);

Route::resource('type_products',ProductTypeController::class);

Route::resource('products',ProductController::class);

Route::get('/products/{id}/edit',[UserController::class, 'edit']);

Route::resource('slides',SlideController::class);
Route::get('/users/{{id}}/edit',function(){
        return view('admin.user-edit');
        });
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
    Route::get('users',function(){
        return view('admin.user-list');
    } );

            Route::group(['prefix'=>'category'],function(){
                Route::get('users',[UserController::class,'index'])->name('admin.user-list');
            });
    });

    Route::resource('bills',BillController::class);
