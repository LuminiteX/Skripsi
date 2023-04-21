<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\CategoryController as OwnerCategoryController;
use App\Http\Controllers\Owner\MenuController as OwnerMenuController;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;
use App\Http\Controllers\Owner\ReservationController2 as OwnerReservationController2;
use App\Http\Controllers\Owner\TableController as OwnerTableController;
use App\Http\Controllers\Owner\RestaurantController as OwnerRestaurantController;
use App\Http\Controllers\Owner\TableLayoutController as OwnerTableLayoutController;
use App\Http\Controllers\Owner\CommentController as OwnerCommentController;
use App\Http\Controllers\Owner\FeedbackController as OwnerFeedbackController;
use App\Http\Controllers\Owner\ChartController as OwnerChartController;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminManageUserController;
use App\Http\Controllers\Admin\AdminManageRestaurantEligibility;



use App\Http\Controllers\Customer\CategoryController as CustomerCategoryController;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Customer\ReservationController as CustomerReservationController;
use App\Http\Controllers\Customer\RestaurantController as CustomerRestaurantController;
use App\Http\Controllers\Customer\CommentController as CustomerCommentController;
use App\Http\Controllers\Customer\CartController as CustomerCartController;
use App\Http\Controllers\Customer\CustomerController as CustomerController;
use App\Http\Controllers\Customer\FeedbackController as CustomerFeedbackController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return redirect()->route('login');
});

// Route::middleware(['auth', 'customer'])->name('customer.')->prefix('customer')->group(function () {
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/home', [CustomerController::class, 'index']);
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
    Route::post('/reservation/step-two/with-menu/{restaurant}', [CustomerReservationController::class, 'storeStepTwoWithMenu'])->name('reservations.store.step.two.with.menu');

    Route::get('/menu/{restaurant}/{reservation}',[CustomerMenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/sort-by/{category}/{reservation}',[CustomerCategoryController::class, 'sortByCategory'])->name('menu.sort.by');
    Route::get('/menu/sort-by/menu-detail/{menu}/{reservation}',[CustomerCategoryController::class, 'menuDetailFromCategory'])->name('menu.sort.by.menu.detail');
    Route::get('/menu/menu-detail/{menu}/{reservation}',[CustomerMenuController::class, 'menuDetail'])->name('menu.detail');

    Route::post('/cart/store/{restaurant}/{reservation}',[CustomerCartController::class, 'store'])->name('cart.store');
    Route::post('/cart/from-category/store/{category}/{reservation}',[CustomerCartController::class, 'storeFromCategory'])->name('cart.store.from.category');
    Route::get('/cart/list/detail/{reservation}',[CustomerCartController::class, 'detail'])->name('cart.list.detail');
    Route::get('/cart/list/detail/edit/{menu}/{reservation}/{cart_detail}',[CustomerCartController::class, 'cartDetailUpdate'])->name('cart.list.detail.update');
    Route::put('/cart/list/detail/edit/save/{reservation}/{cart_detail}',[CustomerCartController::class, 'saveUpdate'])->name('cart.list.detail.update.save');
    Route::delete('/cart/list/detail/delete/{reservation}/{cart_detail}',[CustomerCartController::class, 'deleteItem'])->name('cart.list.detail.delete');
    Route::put('/cart/list/detail/confirm/{reservation}',[CustomerCartController::class, 'confirmTransaction'])->name('cart.list.confirm');
    Route::put('/cart/list/cancel/{reservation}',[CustomerCartController::class, 'cancel'])->name('cart.cancel');

    Route::get('/reservation/detail/with-menu/{reservations}',[CustomerReservationController::class, 'reservationDetailWithMenu'])->name('reservations.detail.with.menu');
    Route::get('/reservation/detail/upload-receipt/{reservations}',[CustomerReservationController::class, 'reservationDetailUploadReceipt'])->name('reservations.detail.upload.receipt');
    Route::put('/reservation/detail/with-menu/store/{reservation}',[CustomerReservationController::class, 'uploadProof'])->name('reservations.detail.with.menu.store');
    Route::get('/cart/list',[CustomerCartController::class, 'index'])->name('cart.list');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.show.profile');
    Route::get('/profile/edit', [CustomerController::class, 'edit'])->name('customer.profile.edit');
    Route::put('/profile/edit/save', [CustomerController::class, 'editSave'])->name('customer.profile.edit.save');
    Route::get('/reservation/list', [CustomerReservationController::class, 'index'])->name('reservations.list');
    Route::put('/reservation/list/cancel/{reservation}',[CustomerReservationController::class, 'cancel'])->name('reservations.list.cancel');
    Route::get('/reservation/history', [CustomerReservationController::class, 'history'])->name('reservations.history');
    Route::get('/reservation/detail/without-menu/{reservations}', [CustomerReservationController::class, 'reservationDetailWithoutMenu'])->name('reservations.detail.without.menu');
    Route::get('/reservation/feedback/{reservation}', [CustomerFeedbackController::class, 'index'])->name('reservations.feedback');
    Route::post('/reservation/feedback/store/{reservation}', [CustomerFeedbackController::class, 'store'])->name('reservations.feedback.store');
});

// Route::get('/testing', [WelcomeController::class, 'test']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// part ini tolong jangan di ganti thanks

Route::middleware(['auth', 'owner'])->name('owner.')->prefix('owner')->group(function () {
    Route::get('/', [OwnerController::class, 'index'])->name('index');
    Route::get('/chart', [OwnerChartController::class, 'index'])->name('charts.index');
    Route::get('/profile', [OwnerController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [OwnerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [OwnerController::class, 'editSave'])->name('profile.edit.save');
    Route::get('/restaurant/create', [OwnerRestaurantController::class, 'index'])->name('restaurant.index');
    Route::post('/restaurant/create', [OwnerRestaurantController::class, 'create'])->name('restaurant.create');
    Route::get('/restaurant/profile', [OwnerRestaurantController::class, 'profile'])->name('restaurant.profile');
    Route::get('/restaurant/profile/activate', [OwnerRestaurantController::class, 'activate'])->name('restaurant.profile.activate');
    Route::get('/restaurant/profile/deactivate', [OwnerRestaurantController::class, 'deactivate'])->name('restaurant.profile.deactivate');
    Route::get('/restaurant/profile/edit', [OwnerRestaurantController::class, 'edit'])->name('restaurant.profile.edit.show');
    Route::put('/restaurant/profile/edit/{restaurant}', [OwnerRestaurantController::class, 'editSave'])->name('restaurant.profile.edit.save');
    Route::get('/feedback', [OwnerFeedbackController::class, 'index'])->name('feedback');
    Route::get('/feedback/rate/asc', [OwnerFeedbackController::class, 'rateAsc'])->name('feedback.rate.asc');
    Route::get('/feedback/rate/desc', [OwnerFeedbackController::class, 'rateDesc'])->name('feedback.rate.desc');
    Route::get('/feedback/date/asc', [OwnerFeedbackController::class, 'dateAsc'])->name('feedback.date.asc');
    Route::get('/feedback/date/desc', [OwnerFeedbackController::class, 'dateDesc'])->name('feedback.date.desc');
    Route::get('/comment', [OwnerCommentController::class, 'index'])->name('comments.index');
    Route::post('/comment/send/{restaurant}', [OwnerCommentController::class, 'send'])->name('comments.send');
    Route::delete('/comments/destroy/{comments}', [OwnerCommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comment/reply/show/{comments}', [OwnerCommentController::class, 'reply'])->name('comments.reply.show');
    Route::post('/comment/reply/send/{restaurant}', [OwnerCommentController::class, 'sendReply'])->name('comments.reply.send');
    Route::put('/reservation/reject/{reservation}', [OwnerReservationController2::class, 'reject'])->name('reservations.reject');
    Route::get('/reservation/sort_by_date_desc', [OwnerReservationController2::class, 'sortByDateDesc'])->name('reservations.sort_by_date_desc');
    Route::get('/reservation/sort_by_status', [OwnerReservationController2::class, 'sortByStatus'])->name('reservations.sort_by_status');
    Route::get('/reservation/sort_by_date_now', [OwnerReservationController2::class, 'sortByDateNowUntilFuture'])->name('reservations.sort_by_date_now');
    Route::get('/reservation/sort_by_guest_number', [OwnerReservationController2::class, 'sortByGuestNumber'])->name('reservations.sort_by_guest_number');
    Route::get('/reservation/not_eligible/{reservation}', [OwnerReservationController2::class, 'notEligible'])->name('reservations.not_eligible');
    Route::get('/reservation/finish/{reservation}', [OwnerReservationController2::class, 'finish'])->name('reservations.finish');
    // Route::get('/reservation/view/{reservation}',[ReservationController2::class, 'reservationView'])->name('reservation.view');
    Route::resource('/categories', OwnerCategoryController::class);
    Route::resource('/menus', OwnerMenuController::class);
    Route::resource('/tables', OwnerTableController::class);
    Route::resource('/table_layouts', OwnerTableLayoutController::class);
    Route::resource('/reservations', OwnerReservationController::class);

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
