<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Restaurant;


class AdminManageRestaurantEligibility extends Controller
{

    public function index(){

        $restaurants = Restaurant::paginate(10);

        return view('admin.manage_restaurant_eligibility.index', compact('restaurants'));
    }

    public function notEligible(Restaurant $restaurant){
        Restaurant::where('id', $restaurant->id)
            ->update([
                'restaurant_status' => 0,
            ]);

            return to_route('admin.manage.restaurant')->with('danger', 'Restaurant status has been change to not eligible');
    }

    public function Eligible(Restaurant $restaurant){
        Restaurant::where('id', $restaurant->id)
        ->update([
            'restaurant_status' => 1,
        ]);

        return to_route('admin.manage.restaurant')->with('success', 'Restaurant status has been change to eligible');
    }
}
