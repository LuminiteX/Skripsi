<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\Owner\ReservationController;
use App\Http\Controllers\Owner\ReservationController2;
use App\Http\Controllers\Owner\TableController;
use App\Http\Controllers\Owner\RestaurantController;
use App\Http\Controllers\Owner\TableLayoutController;
use App\Http\Controllers\Owner\CommentController;
use App\Http\Controllers\Owner\FeedbackOwnerController;
use App\Http\Controllers\Owner\ChartController;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminManageUserController;
use App\Http\Controllers\Admin\AdminManageRestaurantEligibility;



use App\Http\Controllers\Customer\CategoryController as CustomerCategoryController;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Customer\ReservationController as CustomerReservationController;
use App\Http\Controllers\Customer\RestaurantController as CustomerRestaurantController;
use App\Http\Controllers\Customer\CommentController as CustomerCommentController;
use App\Http\Controllers\Customer\WelcomeController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('generate', function (){
    // part penting untuk membuat php artisan storage:link tampa command prompt !!!!!!!!!
//     \Illuminate\Support\Facades\Artisan::call('storage:link');
//     return view('customer.home');
// });

// Route::middleware(['auth', 'customer'])->name('customer.')->prefix('customer')->group(function () {
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/home', [WelcomeController::class, 'index']);
    Route::get('/restaurant_list', [CustomerRestaurantController::class, 'index'])->name('restaurants.list');
    Route::get('/search', [CustomerRestaurantController::class, 'search'])->name('restaurants.search');
    Route::get('/detail/{restaurants}', [CustomerRestaurantController::class, 'detail'])->name('restaurants.details');
    Route::post('/comment/send/{restaurant}', [CustomerCommentController::class, 'send'])->name('customer.comments.send');
    Route::post('/comment/reply/{restaurant}', [CustomerCommentController::class, 'reply'])->name('customer.comments.reply');
    Route::delete('/comment/destroy/{comments}', [CustomerCommentController::class, 'destroy'])->name('customer.comments.reply.destroy');
    Route::get('/reservation/step-one/{restaurant}', [CustomerReservationController::class, 'stepOne'])->name('reservations.step.one');
    Route::post('/step-one/store', [CustomerReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
    Route::get('/reservation/step-two', [CustomerReservationController::class, 'stepTwo'])->name('reservations.step.two');
    Route::post('/reservation/step-two/{restaurant}', [CustomerReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');

    // Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
    // Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
    // Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
    // Route::get('/reservation/step-one', [FrontendReservationController::class, 'stepOne'])->name('reservations.step.one');
    // Route::post('/reservation/step-one', [FrontendReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
    // Route::get('/reservation/step-two', [FrontendReservationController::class, 'stepTwo'])->name('reservations.step.two');
    // Route::post('/reservation/step-two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');
    // Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');
});

// Route::get('/testing', [WelcomeController::class, 'test']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// part ini tolong jangan di ganti thanks

Route::middleware(['auth', 'owner'])->name('owner.')->prefix('owner')->group(function () {
    Route::get('/', [OwnerController::class, 'index'])->name('index');
    Route::get('/chart', [ChartController::class, 'index'])->name('charts.index');
    Route::get('/profile', [OwnerController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [OwnerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [OwnerController::class, 'editSave'])->name('profile.edit.save');
    Route::get('/restaurant/create', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::post('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::get('/restaurant/profile', [RestaurantController::class, 'profile'])->name('restaurant.profile');
    Route::get('/restaurant/profile/activate', [RestaurantController::class, 'activate'])->name('restaurant.profile.activate');
    Route::get('/restaurant/profile/deactivate', [RestaurantController::class, 'deactivate'])->name('restaurant.profile.deactivate');
    Route::get('/restaurant/profile/edit', [RestaurantController::class, 'edit'])->name('restaurant.profile.edit.show');
    Route::put('/restaurant/profile/edit/{restaurant}', [RestaurantController::class, 'editSave'])->name('restaurant.profile.edit.save');
    Route::get('/feedback', [FeedbackOwnerController::class, 'index'])->name('feedback');
    Route::get('/feedback/rate/asc', [FeedbackOwnerController::class, 'rateAsc'])->name('feedback.rate.asc');
    Route::get('/feedback/rate/desc', [FeedbackOwnerController::class, 'rateDesc'])->name('feedback.rate.desc');
    Route::get('/feedback/date/asc', [FeedbackOwnerController::class, 'dateAsc'])->name('feedback.date.asc');
    Route::get('/feedback/date/desc', [FeedbackOwnerController::class, 'dateDesc'])->name('feedback.date.desc');
    Route::get('/comment', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/comment/send/{restaurant}', [CommentController::class, 'send'])->name('comments.send');
    Route::delete('/comments/destroy/{comments}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comment/reply/show/{comments}', [CommentController::class, 'reply'])->name('comments.reply.show');
    Route::post('/comment/reply/send/{restaurant}', [CommentController::class, 'sendReply'])->name('comments.reply.send');
    Route::get('/reservation/reject/{reservation}', [ReservationController2::class, 'reject'])->name('reservations.reject');
    Route::get('/reservation/sort_by_status', [ReservationController2::class, 'sortByStatus'])->name('reservations.sort_by_status');
    Route::get('/reservation/sort_by_date_now', [ReservationController2::class, 'sortByDateNowUntilFuture'])->name('reservations.sort_by_date_now');
    Route::get('/reservation/sort_by_guest_number', [ReservationController2::class, 'sortByGuestNumber'])->name('reservations.sort_by_guest_number');
    Route::get('/reservation/not_eligible/{reservation}', [ReservationController2::class, 'notEligible'])->name('reservations.not_eligible');
    Route::get('/reservation/finish/{reservation}', [ReservationController2::class, 'finish'])->name('reservations.finish');
    // Route::get('/reservation/view/{reservation}',[ReservationController2::class, 'reservationView'])->name('reservation.view');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/table_layouts', TableLayoutController::class);
    Route::resource('/reservations', ReservationController::class);
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/manage/user', [AdminManageUserController::class, 'index'])->name('manage.user');
    Route::delete('/manage/user/delete/{user}', [AdminManageUserController::class, 'deleteUser'])->name('manage.user.delete');
    Route::get('/manage/restaurant', [AdminManageRestaurantEligibility::class, 'index'])->name('manage.restaurant');
    Route::put('/manage/restaurant/eligible/{restaurant}', [AdminManageRestaurantEligibility::class, 'Eligible'])->name('manage.restaurant.eligible');
    Route::put('/manage/restaurant/not_eligible/{restaurant}', [AdminManageRestaurantEligibility::class, 'notEligible'])->name('manage.restaurant.not_eligible');
});

require __DIR__ . '/auth.php';
