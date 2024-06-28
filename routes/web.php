<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\OrderController;
use App\Models\Customer;

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
    return view('auth.login');
});
  
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::middleware(['role:customer', 'verified'])->group(function () {
     Route::prefix('customer')->group(function(){
        Route::name('customer.')->group(function(){
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/wisata/{wisata}', [CustomerController::class, 'tampilkan'])->name('show');
        Route::get('/explore', [CustomerController::class, 'explore'])->name('explore');
        Route::get('/order', [CustomerController::class, 'summary'])->name('summary');
        
            });
        });
    });


// SUPERADMIN
Route::group(['middleware' => ['role:superadmin']], function() {
    Route::prefix('superadmin')->group(function() {
        Route::name('superadmin.')->group(function() {
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);
        });
    });
});

// VENDOR
Route::group(['middleware' => ['role:vendor']],function(){
    Route::prefix('vendor')->group(function(){
        Route::name('vendor.')->group(function(){
            Route::get('/home', [VendorController::class, 'index'])->name('index');
            Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
            Route::get('/produk', [VendorController::class, 'wisata'])->name('produk');
            Route::get('/add', [WisataController::class, 'create'])->name('create');
            Route::post('/store', [WisataController::class, 'store'])->name('store');
            Route::get('/profil', [VendorController::class, 'profil'])->name('profil');
            Route::get('/wisata/{wisata}', [WisataController::class, 'tampilkan'])->name('show');
           
        });
    });
    
    });
