<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\ViewCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Database\Eloquent\Model;

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
            'description' => ['required', 'min:20', 'max:255'],
            'phone_number' => ['required', 'regex:/^\+?\d{7,15}$/', 'unique:restaurants'],
            'opening_time' => ['required', 'date_format:H:i', 'before_or_equal:closing_time'],
            'closing_time' => ['required', 'date_format:H:i'],
            'address' => ['required', 'min:20', 'max:255'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg'],
        ], [
            'opening_time.before_or_equal' => 'The opening time must be before or equal to the closing time.',
            'image.mimes' => 'The uploaded file must be in an image format'
        ]);

        $image = $request->file('image');

        $dateTime = now()->format('Ymd_His');

        $filename = $dateTime . '_' . $image->getClientOriginalName();

        $newPath = $request->file('image')->storeAs('public/restaurant_picture', $filename);

        $user_id = Auth::id();

        $restaurant = Restaurant::create([
            'user_id' => $user_id,
            'name' => $request->restaurant_name,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'address' => $request->address,
            'picture' => $newPath,
        ]);

        // same as bellow just another way to create it
        // $id = auth()->id();

        // User::where('id', $id)
        //     ->update([
        //         'has_restaurant' => 1,
        //     ]);

        if (auth()->check()) {
            $user = auth()->user();
            $user->has_restaurant = 1;
            $user->save();
        }

        // dd($user_id);

        return view('owner.index');
    }

    public function profile()
    {
        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();

        return view('owner.restaurant.profile')->with('restaurant', $restaurant);
    }

    public function activate(){

        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();

        Restaurant::where('id', $restaurant->id)
        ->update([
            'restaurant_opening_status' => 1,
        ]);

        return view('owner.restaurant.profile')->with('restaurant', $restaurant);
    }

    public function deactivate(){
        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        Restaurant::where('id', $restaurant->id)
        ->update([
            'restaurant_opening_status' => 0,
        ]);
        return view('owner.restaurant.profile')->with('restaurant', $restaurant);
    }

}
