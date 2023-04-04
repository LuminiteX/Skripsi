<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\Owner\ReservationController;
use App\Http\Controllers\Owner\TableController;
use App\Http\Controllers\Owner\RestaurantController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminTableController;

use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

// Route::middleware(['auth', 'customer'])->name('customer.')->prefix('customer')->group(function () {
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/home', [WelcomeController::class, 'index']);
    Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
    Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
    Route::get('/reservation/step-one', [FrontendReservationController::class, 'stepOne'])->name('reservations.step.one');
    Route::post('/reservation/step-one', [FrontendReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
    Route::get('/reservation/step-two', [FrontendReservationController::class, 'stepTwo'])->name('reservations.step.two');
    Route::post('/reservation/step-two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');
    Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');
});

Route::get('/testing', [WelcomeController::class, 'test']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// part ini tolong jangan di ganti thanks

Route::middleware(['auth', 'owner'])->name('owner.')->prefix('owner')->group(function () {
    Route::get('/', [OwnerController::class, 'index'])->name('index');
    Route::get('/restaurant/create', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::post('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::get('/restaurant/profile', [RestaurantController::class, 'profile'])->name('restaurant.profile');
    // Route::get('/restaurant/profile/activate',)
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/reservations', ReservationController::class);
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/menus', AdminMenuController::class);
    Route::resource('/tables', AdminTableController::class);
    Route::resource('/reservations', AdminReservationController::class);
});

require __DIR__ . '/auth.php';
