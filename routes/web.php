<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class,'index'])->name('index');
Route::get('/inscription',[UserController::class,'signupPage'])->name('signUp')->middleware('non.user');
Route::get('/se-connecter',[UserController::class,'loginPage'])->name('login')->middleware('guest');
Route::get('/modifier/{user}',[UserController::class,'editPage'])->name('edit')->middleware('can:update,user');
Route::get('/tableau-de-bord',[UserController::class,'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/authentifier', [UserController::class, 'authenticate'])->name('loginAction')->middleware('guest');
Route::post('/deconnecter',[UserController::class,'logout'])->name('logout')->middleware('auth');
Route::post('/store',[UserController::class,'store'])->name('store')->middleware('non.user');
Route::post('/sauvegarder',[UserController::class,'store'])->name('store')->middleware('non.user');
Route::put('/modifier/{user}',[UserController::class,'update'])->name('editAction')->middleware('can:update,user');
Route::delete('/corbeille/{user}',[UserController::class,'bin'])->name('bin')->middleware('can:delete,user');
Route::delete('/delete/{user}',[UserController::class,'delete'])->name('delete')->middleware('can:forceDelete,user','admin');
