<?php

use App\Http\Controllers\{BrandController, CategoryController, CustomerController, FrontendController, HomeController, ProfileController};
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

//FrontendController
Route::get('/', [FrontendController::class, 'index'])->name('/');
Route::get('about-us', [FrontendController::class, 'about'])->name('about');
Route::get('contact-us', [FrontendController::class, 'contact'])->name('contact');
Route::post('contact-us', [FrontendController::class, 'contact_post'])->name('contact.post');
Route::get('team', [FrontendController::class, 'team']);
Route::post('team/insert', [FrontendController::class, 'teaminsert']);
Route::get('team/softdelete/{id}', [FrontendController::class, 'teamSoftDelete']);
Route::get('team/edit/{id}', [FrontendController::class, 'teamEdit']);
Route::post('team/edit/post/{id}', [FrontendController::class, 'teamEditPost']);
Route::get('team/restore/{id}', [FrontendController::class, 'teamRestore']);
Route::get('team/delete/{id}', [FrontendController::class, 'teamDelete']);

Auth::routes();

//HomeController
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users', [HomeController::class, 'users'])->name('users');

// ProfileController
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/photo/update', [ProfileController::class, 'profile_photo_upload'])->name('profile/photo/update');
Route::post('/cover/photo/update', [ProfileController::class, 'cover_photo_upload'])->name('cover/photo/update');
Route::post('change/password', [ProfileController::class, 'change_password'])->name('change/password');
Route::get('/send/verfication/code', [ProfileController::class, 'send_verfication_code'])->name('send/verfication/code');
Route::post('check/code', [ProfileController::class, 'check_code'])->name('check/code');

// CustomerController
Route::get('/account', [CustomerController::class, 'account'])->name('account');
Route::post('/customer/register', [CustomerController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/login', [CustomerController::class, 'customer_login'])->name('customer.login');

// CategoryController
Route::resource('/category', CategoryController::class);

// BrandController
Route::resource('/brand', BrandController::class);
Route::post('/brand/list', [BrandController::class, 'list'])->name('brand_list');

