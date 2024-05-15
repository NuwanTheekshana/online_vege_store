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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.Login');
});

// // cookies
// Route::get('/cookie-consent', CookieConsentController::class, '__invoke')->name('cookieConsent');


Route::post('/customer_subscribe', [App\Http\Controllers\user_controller::class, 'customer_subscribe'])->name('customer_subscribe');

Auth::routes();
Route::group(['middleware' => 'auth'], function ()
{

Route::post('/registeruser', [App\Http\Controllers\user_controller::class, 'registeruser'])->name('registeruser');
Route::get('/admin/login', [App\Http\Controllers\admin\admin_controller::class, 'admin_login'])->name('admin_login');
Route::get('/admin/admin_register', [App\Http\Controllers\admin\admin_controller::class, 'admin_register'])->name('admin_register');
Route::post('/admin/admin_user_register', [App\Http\Controllers\admin\admin_controller::class, 'admin_user_register'])->name('admin_user_register');
Route::post('/admin/admin_login_user', [App\Http\Controllers\admin\admin_controller::class, 'admin_login_user'])->name('admin_login_user');
Route::get('/admin/adminhome', [App\Http\Controllers\admin\admin_controller::class, 'adminhome'])->name('adminhome');
Route::get('/admin/admin_add_product', [App\Http\Controllers\admin\admin_controller::class, 'admin_add_product'])->name('admin_add_product');
Route::get('/admin/admin_find_product', [App\Http\Controllers\admin\admin_controller::class, 'admin_find_product'])->name('admin_find_product');
Route::get('/admin/add_promotion', [App\Http\Controllers\admin\admin_controller::class, 'add_promotion'])->name('add_promotion');
Route::post('/admin/promo_add', [App\Http\Controllers\admin\admin_controller::class, 'promo_add'])->name('promo_add');
Route::get('/admin/pending_orders', [App\Http\Controllers\admin\admin_controller::class, 'pending_orders'])->name('pending_orders');


Route::post('/admin/compete_order_update', [App\Http\Controllers\admin\admin_controller::class, 'compete_order_update'])->name('compete_order_update');
Route::post('/admin/reject_order_update', [App\Http\Controllers\admin\admin_controller::class, 'reject_order_update'])->name('reject_order_update');

// promotion
Route::post('/admin/promotion_remove', [App\Http\Controllers\admin\admin_controller::class, 'promotion_remove'])->name('promotion_remove');
Route::post('/admin/update_promotion_details', [App\Http\Controllers\admin\admin_controller::class, 'update_promotion_details'])->name('update_promotion_details');


// shopping
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shopping', [App\Http\Controllers\shopping_controller::class, 'shopping'])->name('shopping');
Route::get('/whishlist', [App\Http\Controllers\shopping_controller::class, 'whishlist'])->name('whishlist');
Route::get('/cart', [App\Http\Controllers\shopping_controller::class, 'cart'])->name('cart');
Route::get('/checkout', [App\Http\Controllers\shopping_controller::class, 'checkout'])->name('checkout');

// add to shopping cart
Route::post('/add_to_cart', [App\Http\Controllers\shopping_controller::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/remove_cart_item', [App\Http\Controllers\shopping_controller::class, 'remove_cart_item'])->name('remove_cart_item');

// order
Route::post('/order_place', [App\Http\Controllers\shopping_controller::class, 'order_place'])->name('order_place');


// about
Route::get('/about_us', [App\Http\Controllers\about_controller::class, 'about_us'])->name('about_us');
Route::get('/contact_us', [App\Http\Controllers\about_controller::class, 'contact_us'])->name('contact_us');

// product details
Route::get('/product_details/{id}', [App\Http\Controllers\shopping_controller::class, 'product_details'])->name('product_details');

// item_add
Route::post('/item_add', [App\Http\Controllers\product_controller::class, 'item_add'])->name('item_add');
Route::post('/update_product_details', [App\Http\Controllers\product_controller::class, 'update_product_details'])->name('update_product_details');
Route::post('/product_remove', [App\Http\Controllers\product_controller::class, 'product_remove'])->name('product_remove');

// prmotion
Route::post('/validate_promotion_code', [App\Http\Controllers\shopping_controller::class, 'validate_promotion_code'])->name('validate_promotion_code');
Route::post('/change_cart_itme_quntity', [App\Http\Controllers\shopping_controller::class, 'change_cart_itme_quntity'])->name('change_cart_itme_quntity');


// payment option
Route::get('/online_payment', [App\Http\Controllers\shopping_controller::class, 'online_payment'])->name('online_payment');
Route::post('/payment_success', [App\Http\Controllers\shopping_controller::class, 'payment_success'])->name('payment_success');

// lodding page
Route::get('/lodding_page', [App\Http\Controllers\shopping_controller::class, 'lodding_page'])->name('lodding_page');

// whishlist
Route::post('/add_whishlist', [App\Http\Controllers\shopping_controller::class, 'add_whishlist'])->name('add_whishlist');

});