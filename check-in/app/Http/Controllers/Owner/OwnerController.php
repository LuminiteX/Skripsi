<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class OwnerController extends Controller
{
    public function index()
    {
        // Get the current user
        $user = auth()->user();

        // Check if the user has a restaurant
        if ($user->has_restaurant == 1) {
            $restaurant = Restaurant::where('user_id', $user->id)->first();
            // dd($restaurant);
            session()->put('restaurant', $restaurant);
        }


        return view('owner.index');
    }
}
