<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('owner.restaurant.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'restaurant_name' => ['required', 'max:255'],
            'description' => ['required', 'min:20'],
            'phone_number' => ['required', 'regex:/^\+?\d{7,15}$/', 'unique:users'],
            'opening_time' => ['required'],
            'closing_time' => ['required'],
            'address' => ['required', 'min:20'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        dd($request);
    }
}
