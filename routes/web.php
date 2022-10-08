<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'can:admin-role']], function () {
Route::get('/users', [App\Http\Controllers\UserController::class, 'users']);
Route::any('/detail/{id}', [App\Http\Controllers\UserController::class, 'detail']);
});
Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::any('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    // getでもらいpostで保存するイメージ/edit{id}からもらいitemのコントローラーに渡しmodelと処理を行いviewで返す
});
