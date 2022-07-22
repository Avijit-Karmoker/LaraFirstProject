<?php

use App\Http\Controllers\{FrontendController, HomeController};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [FrontendController::class, 'index']);
Route::get('about', [FrontendController::class, 'about']);
Route::get('contact', [FrontendController::class, 'contact']);
Route::get('team', [FrontendController::class, 'team']);
Route::post('team/insert', [FrontendController::class, 'teaminsert']);
Route::get('team/softdelete/{id}', [FrontendController::class, 'teamSoftDelete']);
Route::get('team/edit/{id}', [FrontendController::class, 'teamEdit']);
Route::post('team/edit/post/{id}', [FrontendController::class, 'teamEditPost']);
Route::get('team/restore/{id}', [FrontendController::class, 'teamRestore']);
Route::get('team/delete/{id}', [FrontendController::class, 'teamDelete']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users', [HomeController::class, 'users'])->name('users');
