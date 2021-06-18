<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', 'ProductsController')->middleware('auth')->name('home');

Route::group(['middleware' => ['auth']], function (){
    Route::get('/home',[ProductsController::class,'index'])->name('home');
    Route::get('/create',[ProductsController::class,'create'])->name('products.create');
    Route::post('/create',[ProductsController::class,'store'])->name('products.store');
    Route::get('/edit/{id}',[ProductsController::class,'edit'])->name('products.edit');
    Route::get('/edit/{id}',[ProductsController::class,'edit'])->name('products.edit');
    Route::patch('/update/{id}',[ProductsController::class,'update'])->name('products.update');
    Route::delete('/delete/{id}',[ProductsController::class,'destroy'])->name('products.destroy');

});

