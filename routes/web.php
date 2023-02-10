<?php

use App\Http\Controllers\{BrandController, CategoryController, CouponController, CustomerController, FrontendController, HomeController, ProductController, ProfileController, SslCommerzPaymentController, VariationController, VendorController};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::get('/product/details/{id}', [FrontendController::class, 'product_details'])->name('product.details');
Route::get('about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [FrontendController::class, 'checkout_post'])->name('checkout.post');
Route::post('/getcitylist', [FrontendController::class, 'getcitylist'])->name('getcitylist');
Route::get('contact-us', [FrontendController::class, 'contact'])->name('contact');
Route::post('contact-us', [FrontendController::class, 'contact_post'])->name('contact.post');
Route::get('team', [FrontendController::class, 'team']);
Route::post('team/insert', [FrontendController::class, 'teaminsert']);
Route::get('team/softdelete/{id}', [FrontendController::class, 'teamSoftDelete']);
Route::get('team/edit/{id}', [FrontendController::class, 'teamEdit']);
Route::post('team/edit/post/{id}', [FrontendController::class, 'teamEditPost']);
Route::get('team/restore/{id}', [FrontendController::class, 'teamRestore']);
Route::get('team/delete/{id}', [FrontendController::class, 'teamDelete']);

Auth::routes(['register' => false]);

//HomeController
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth', 'verified');
Route::post('/add/users', [HomeController::class, 'add_user'])->name('add_user');
Route::post('/vendor/action/change/{id}', [HomeController::class, 'vendor_action_change'])->name('vendor.action.change');

// ProfileController
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/photo/update', [ProfileController::class, 'profile_photo_upload'])->name('profile/photo/update');
Route::post('/cover/photo/update', [ProfileController::class, 'cover_photo_upload'])->name('cover/photo/update');
Route::post('change/password', [ProfileController::class, 'change_password'])->name('change/password');
Route::get('/send/verfication/code', [ProfileController::class, 'send_verfication_code'])->name('send/verfication/code');
Route::post('check/code', [ProfileController::class, 'check_code'])->name('check/code');

// CustomerController
Route::get('/account', [CustomerController::class, 'account'])->name('account');
Route::get('download/invoice/{id}', [CustomerController::class, 'download_invoice'])->name('download.invoice');
Route::get('download/invoice/all/{id}', [CustomerController::class, 'download_invoice_all'])->name('download.invoice.all');
Route::post('/customer/register', [CustomerController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/login', [CustomerController::class, 'customer_login'])->name('customer.login');
Route::get('/give/review/{id}', [CustomerController::class, 'give_review'])->name('give.review');
Route::post('/insert/review/{invoice_details_id}', [CustomerController::class, 'insert_review'])->name('insert.review');

//Email verification Notice
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Vendor
Route::get('/vendor/regestration', [VendorController::class, 'vendor_regestration'])->name('vendor.regestration');
Route::post('/vendor/regestration', [VendorController::class, 'vendor_regestration_post'])->name('vendor.regestration.post');
Route::get('/vendor/login', [VendorController::class, 'vendor_login'])->name('vendor.login');
Route::Post('/vendor/login', [VendorController::class, 'vendor_login_post'])->name('vendor.login.post');
Route::get('/vendor/order/{id}', [VendorController::class, 'vendor_order'])->name('vendor.order');
Route::post('/vendor/order/status/change/{id}', [VendorController::class, 'vendor_order_status_change'])->name('vendor.order.status.change');

//Middleware
Route::middleware(['admin_rolechecker'])->group(function () {
    //HomeController
    Route::get('/users', [HomeController::class, 'users'])->name('users');
    // CategoryController
    Route::resource('/category', CategoryController::class);
    // BrandController
    Route::resource('/brand', BrandController::class);
    Route::post('/brand/list', [BrandController::class, 'list'])->name('brand_list');
});

//ProductController
Route::resource('/product', ProductController::class);
Route::get('/product/add/inventory/{product}', [ProductController::class, 'addinventory'])->name('product.add.inventory');
Route::post('/product/add/inventory/{product}', [ProductController::class, 'addinventorypost'])->name('product.add.inventory.post');

// VariationController
Route::resource('/variation', VariationController::class);

//CouponController
Route::resource('coupon', CouponController::class);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
