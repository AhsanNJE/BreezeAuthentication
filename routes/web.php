<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

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
////////////----------------------- Admin Route ------------------------------///////////////////////
Route::prefix('admin')->group(function (){
    Route::get('/login', [AdminController::class, 'Index'])->name('login_from');
    Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');
    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create', [AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');

});
////////////----------------------------- End Admin Route ---------------------////////////////////////

////////////----------------------- Seller Route ------------------------------///////////////////////
Route::prefix('seller')->group(function (){
    Route::get('/login', [SellerController::class, 'Index'])->name('seller_login_from');
    Route::post('/login/owner', [SellerController::class, 'Login'])->name('seller.login');
    Route::get('/dashboard', [SellerController::class, 'Dashboard'])->name('seller.dashboard')->middleware('seller');
    Route::get('/logout', [SellerController::class, 'SellerLogout'])->name('seller.logout')->middleware('seller');
    Route::get('/register', [SellerController::class, 'SellerRegister'])->name('seller.register');
    Route::post('/register/create', [SellerController::class, 'SellerRegisterCreate'])->name('seller.register.create');

});
////////////----------------------------- End Seller Route ---------------------////////////////////////



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
