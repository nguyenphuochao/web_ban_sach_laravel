<?php

use App\Http\Controllers\APIProductController;
use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\ArticleGroupController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\Customer_orderController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SystemController;
use App\Http\Controllers\Backend\UserController as BackendUserController;
use App\Http\Controllers\Frontend\AjaxController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\UserController;
use GuzzleHttp\Psr7\Request;
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
//----------------------- Front-end--------------------------------------
Route::get('/', [UserController::class, 'index'])->name('f.home');
Route::get('lien-he', [UserController::class, 'contact'])->name('f.contact');
Route::post('lien-he', [UserController::class, 'mail'])->name('f.mail');
Route::get('ve-chung-toi', [UserController::class, 'about'])->name('f.about');
Route::get('chi-tiet-san-pham/{id}', [UserController::class, 'detail'])->name('f.detail');
Route::post('chi-tiet-san-pham/{id}', [UserController::class, 'post_detail_view'])->name('f.post_detail_view');
Route::get('danh-muc/{id}', [UserController::class, 'category'])->name('f.category');
Route::get('quan-li-tai-khoan', [UserController::class, 'account'])->middleware('auth.frontend')->name('f.account');
Route::get('sua-tai-khoan', [UserController::class, 'editAccount'])->middleware('auth.frontend')->name('f.editaccount');
Route::post('sua-tai-khoan', [UserController::class, 'updateAccount'])->middleware('auth.frontend')->name('f.updateaccount');
Route::get('quan-li-tai-khoan/chi-tiet-don-hang/{id}', [UserController::class, 'detailOrder'])->middleware('auth.frontend')->name('f.detail_order');
Route::get('tat-ca-san-pham', [UserController::class, 'all_product'])->name('f.all_product');
Route::post('chi-tiet-san-pham', [UserController::class, 'post_comment'])->name('f.post_comment');

Route::get('dang-nhap', [UserController::class, 'login'])->name('f.login');
Route::post('dang-nhap', [UserController::class, 'post_login'])->name('f.post_login');
Route::get('dang-ky', [UserController::class, 'register'])->name('f.register');
Route::post('dang-ky', [UserController::class, 'post_register'])->name('f.post_register');
Route::get('dang-xuat', [UserController::class, 'logout'])->name('f.logout');
Route::get('dat-hang', [UserController::class, 'order'])->name('f.order');
Route::get('tin-tuc', [UserController::class, 'news'])->name('f.news');
Route::get('chi-tiet-tin-tuc/{id}', [UserController::class, 'news_detail'])->name('f.news_detail');
Route::get('danh-muc-tin-tuc/{id}', [UserController::class, 'article_group'])->name('f.article_group');

Route::get('tim-kiem', [UserController::class, 'search'])->name('f.search');
// ajax tìm kiếm search
Route::get('san-pham/search', [UserController::class, 'search_ajax'])->name('f.search_ajax');
Route::get('ren-pass', [UserController::class, 'renpass'])->name('f.renpass');
// view cart
Route::get('gio-hang', [CartController::class, 'index'])->name('f.cart');
// add to cart
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('f.addcart');
// update cart
Route::put('update-cart', [CartController::class, 'updateCart'])->name('f.updatecart');
// del cart
Route::get('delete-item-cart/{id}', [CartController::class, 'delCart'])->name('f.deletecart');
// view đăt hàng
Route::get('dat-hang', [OrderController::class, 'index'])->middleware('auth.frontend')->name('f.order');
Route::post('dat-hang', [OrderController::class, 'order'])->name('f.save_order');
Route::get('dat-hang-thanh-cong', [OrderController::class, 'order_finish'])->name('f.order_finish');

// Xử lí ajax thành phố,quận,phường
Route::get('ajax/district/{idProvince}', [AjaxController::class, 'getDistrict']);
Route::get('ajax/ward/{idDistrict}', [AjaxController::class, 'getWard']);

// -----------------------Back-end------------------------------------------
Route::get('login', [SystemController::class, 'login'])->name('b.login');
Route::post('login', [SystemController::class, 'post_login'])->name('b.post_login');
Route::get('logout', [SystemController::class, 'logout'])->name('b.logout');
Route::get('register', [SystemController::class, 'register'])->name('b.register');
Route::get('403', [SystemController::class, '_403'])->name('b.403');
// ---------------------Route group cho admin-------------------------------
Route::group(['prefix' => 'admin', 'middleware' => 'auth.backend'], function () {
    Route::get('/', [SystemController::class, 'index'])->name('b.home');

    Route::resource('user', BackendUserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('author', AuthorController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('order', BackendOrderController::class);
    Route::resource('customer_order', Customer_orderController::class);
    Route::resource('comment', CommentController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('article', ArticleController::class);
    Route::resource('article_group', ArticleGroupController::class);
    Route::resource('role', RoleController::class);
    Route::get('setting/log', [SettingController::class, 'log'])->name('b.log');
    Route::get('setting/cau-hinh', [SettingController::class, 'cauhinh'])->name('b.cauhinh');
});

// Test ajax
Route::get('ajax/index', [AjaxController::class, 'index'])->name('f.ajax');
Route::get('ajax/create', [AjaxController::class, 'demo']);
Route::post('ajax/create', [AjaxController::class, 'post_demo'])->name('f.post_demo');
Route::get('ajax/create/{id}', [AjaxController::class, 'del'])->name('f.del_ajax');
