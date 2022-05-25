<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CitiesController;
// Master Data
use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\User\ShopController;

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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('admin.master.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// pvb = Prevent Back History
Route::name('user.')->group(function(){
    Route::middleware(['guest:web', 'pvb'])->group(function(){
        Route::view('/login', 'user.auth.login')->name('login');
        Route::view('/register', 'user.auth.register')->name('register');
        Route::post('/account/create', [UserLoginController::class, 'create'])->name('create');
        Route::post('/account/check', [UserLoginController::class, 'check'])->name('check');
        Route::get('/account/verify', [UserLoginController::class, 'verifyEmail'])->name('verify');
        Route::view('/account/reset/password', 'auth.passwords.email')->name('resetpassword');
    });
    
    Route::middleware(['auth:web', 'IsUserVerified', 'pvb'])->group(function(){
        Route::get('/home', [UserController::class, 'index'])->name('home');
        Route::post('/account/logout', [UserLoginController::class, 'logout'])->name('logout');

        Route::prefix('shop')->name('shop.')->group(function(){
            Route::get('/',[ShopController::class, 'index'])->name('index');
            Route::get('/detail/{id}',[ShopController::class, 'detail'])->name('detail');
        });

        Route::get('/cart', [ShopController::class, 'cart'])->name('cart');

        // USER TRANSACTION
        Route::get('/transaction/{id}', [ShopController::class, 'buynow'])->name('buynow');
        Route::get('/transaction', [ShopController::class, 'transaction'])->name('transaction');
        Route::post('/transaction/save', [ShopController::class, 'transactionSave'])->name('transaction.save');  

        Route::get('/history/transaction/', [ShopController::class, 'historyTransactionIndex'])->name('history.transaction.index');
        Route::get('/history/transaction/{id}', [ShopController::class, 'historyTransaction'])->name('history.transaction');

        Route::post('/transaction/payment/{id}', [ShopController::class, 'payment'])->name('transaction.payment');  
        Route::post('/transaction/payment/edit/{id}', [ShopController::class, 'paymentEdit'])->name('transaction.payment.edit');  
        Route::post('/transaction/cancel/{id}', [ShopController::class, 'cancel'])->name('transaction.cancel');  
        Route::post('/expired/{id}', [ShopController::class, 'expired'])->name('transaction.expired');  
        Route::post('/success/{id}', [ShopController::class, 'success'])->name('transaction.success');  
        Route::post('/transaction/review/{id}/{transaction_id}', [ShopController::class, 'review'])->name('transaction.review'); 
        
        // NOTIFICATION
        Route::get('/notification', [ShopController::class, 'notification'])->name('notification');  

    });    
});
// Redirect to admin login
Route::get('/admin', [AdminLoginController::class, 'redirectLogin']);

Route::prefix('superadmin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin', 'pvb'])->group(function(){
        // Login and redirected miss-uRL
        Route::view('/login', 'admin.auth.login')->name('login');
        Route::get('/admin', [AdminLoginController::class, 'redirectLogin']);
        Route::get('/', [AdminLoginController::class, 'redirectLogin']);

        // Admin Login
        Route::post('/account/check', [AdminLoginController::class, 'check'])->name('check');
    }); 

    Route::middleware(['auth:admin', 'pvb'])->group(function(){
        Route::get('/dashboard', [AdminController::class, 'home'])->name('home');
        Route::get('/notification', [AdminController::class, 'notification'])->name('notification.all');
        Route::post('/account/logout', [AdminLoginController::class, 'logout'])->name('logout');

        // KATEGORI
        Route::prefix('categories')->name('categories.')->group(function(){
            Route::get('/',[CategoryController::class, 'index'])->name('index');
            Route::get('/create',[CategoryController::class, 'create'])->name('create');
            Route::post('/create',[CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[CategoryController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[CategoryController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[CategoryController::class, 'delete'])->name('delete');
        });

        // KURIR - COURIER
        Route::prefix('couriers')->name('couriers.')->group(function(){
            Route::get('/',[CourierController::class, 'index'])->name('index');
            Route::get('/create',[CourierController::class, 'create'])->name('create');
            Route::post('/create',[CourierController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[CourierController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[CourierController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[CourierController::class, 'delete'])->name('delete');
        });

        // PROVINSI
        Route::prefix('province')->name('province.')->group(function(){
            Route::get('/',[ProvinceController::class, 'index'])->name('index');
            Route::get('/create',[ProvinceController::class, 'create'])->name('create');
            Route::post('/create',[ProvinceController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[ProvinceController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[ProvinceController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[ProvinceController::class, 'delete'])->name('delete');
        });

        // KOTA - CITIES
        Route::prefix('cities')->name('cities.')->group(function(){
            Route::get('/{id}',[CitiesController::class, 'index'])->name('index');
            Route::get('/create/{id}',[CitiesController::class, 'create'])->name('create');
            Route::post('/create/{id}',[CitiesController::class, 'store'])->name('store');
            Route::get('/edit/{id}/{kode}',[CitiesController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}/{kode}',[CitiesController::class, 'update'])->name('update');
            Route::post('/delete/{id}/{kode}',[CitiesController::class, 'delete'])->name('delete');
        });

        // AKUN - ADMIN
        Route::prefix('account')->name('account.')->group(function(){
            Route::get('/',[AdminController::class, 'index'])->name('index');
            Route::get('/create',[AdminController::class, 'create'])->name('create');
            Route::post('/create',[AdminController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[AdminController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[AdminController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[AdminController::class, 'delete'])->name('delete');
        });

        // PRODUK - PRODUCT
        Route::prefix('product')->name('product.')->group(function(){
            Route::get('/',[ProductController::class, 'index'])->name('index');
            Route::get('/create',[ProductController::class, 'create'])->name('create');
            Route::post('/create',[ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[ProductController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[ProductController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[ProductController::class, 'delete'])->name('delete');
            Route::post('/activate/{id}',[ProductController::class, 'activate'])->name('activate');
        });

        // PRODUK IMAGE - IMAGE
        Route::prefix('image')->name('image.')->group(function(){
            Route::get('/{id}',[ProductImageController::class, 'index'])->name('index');
            Route::get('/create/{id}',[ProductImageController::class, 'create'])->name('create');
            Route::post('/create/{id}',[ProductImageController::class, 'store'])->name('store');
            Route::get('/edit/{id}/{kode}',[ProductImageController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}/{kode}',[ProductImageController::class, 'update'])->name('update');
            Route::post('/delete/{id}/{kode}',[ProductImageController::class, 'delete'])->name('delete');
        });

        // PRODUK DISKON - DISCOUNT
        Route::prefix('discount')->name('discount.')->group(function(){
            Route::get('/',[DiscountController::class, 'index'])->name('index');
            Route::get('/create',[DiscountController::class, 'create'])->name('create');
            Route::post('/create',[DiscountController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[DiscountController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[DiscountController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[DiscountController::class, 'delete'])->name('delete');
        });

        // TRANSACTION
        Route::prefix('transaction')->name('transaction.')->group(function(){
            Route::get('/',[TransactionController::class, 'index'])->name('index');
            Route::get('/create',[TransactionController::class, 'create'])->name('create');
            Route::post('/create',[TransactionController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[TransactionController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[TransactionController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[TransactionController::class, 'delete'])->name('delete');

            Route::post('/verify/{id}',[TransactionController::class, 'verify'])->name('verify');
            Route::post('/notverified/{id}',[TransactionController::class, 'notverified'])->name('notverified');
            Route::post('/deliver/{id}',[TransactionController::class, 'deliver'])->name('deliver');

        });
        Route::prefix('review')->name('review.')->group(function(){
            Route::get('/',[ReviewController::class, 'index'])->name('index');
            Route::get('/reply/{id}',[ReviewController::class, 'reply'])->name('reply');
            Route::post('/reply/{id}',[ReviewController::class, 'post'])->name('post');
        });

    });
});


