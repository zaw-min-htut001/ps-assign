<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories/list/',[CategoryController::class,'categoryList'])->name('#categoryList');

Route::get('/categories/new/',[CategoryController::class,'newCategory'])->name('#newCategory');

Route::post('/categories/add/',[CategoryController::class,'addCategory'])->name('#addCategory');

Route::get('/categories/edit/{id}',[CategoryController::class,'categoryEdit'])->name('#categoryEdit');

Route::post('/categories/update',[CategoryController::class,'updateCategory'])->name('#updateCategory');

Route::get('/categories/delete/{id}',[CategoryController::class,'deleteCategory'])->name('#deleteCategory');


Route::get('/item/list/',[ItemController::class,'itemList'])->name('#itemList');

Route::get('/item/new/',[ItemController::class,'newItem'])->name('#newItem');

Route::post('/item/add',[ItemController::class,'addItem'])->name('#addItem');

Route::get('/item/delete/{id}',[ItemController::class,'deleteItem'])->name('#deleteItem');

Route::get('/item/edit/{id}',[ItemController::class,'editItem'])->name('#editItem');

Route::post('/item/update',[ItemController::class,'updateItem'])->name('#updateItem');
