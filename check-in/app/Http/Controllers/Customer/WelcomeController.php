<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\Artisan::call('storage:link');
        return view('customer.home');
    }

    public function test()
    {
        // $user = auth()->user();
        // $reservation = $user->reservations;
        // // $restaurants = $user->reservations->restaurant;
        // $restaurants = Restaurant::whereHas('reservations', function ($query) use ($user) {
        //     $query->where('user_id', $user->id);
        // })->get();
        // // dd($restaurants);
        // return view('customer.cart.cart-list', compact('user','restaurants'));
        return view('customer.cart.cart-detail');
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
