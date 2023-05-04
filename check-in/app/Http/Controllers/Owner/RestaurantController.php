<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RestaurantController extends Controller
{
    public function index()
    {
        session()->forget('last_url');

        return view('owner.restaurant.create');
    }

    public function edit()
    {
        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        // return view('owner.restaurant.edit');
        return view('owner.restaurant.edit')->with('restaurant', $restaurant);
    }

    public function create(Request $request)
    {
        $request->validate([
            'restaurant_name' => ['required', 'max:255'],
            'description' => ['required', 'min:20', 'max:255'],
            'phone_number' => ['required', 'regex:/^\+?\d{7,15}$/', 'unique:restaurants'],
            'bank_account' => ['required', 'max:255'],
            'opening_time' => ['required', 'date_format:H:i', 'before_or_equal:closing_time'],
            'closing_time' => ['required', 'date_format:H:i'],
            'address' => ['required', 'min:15', 'max:255'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg'],
        ], [
            'opening_time.before_or_equal' => 'The opening time must be before or equal to the closing time.',
            'description.min' => 'Please put more detailed information about the restaurant description',
            'bank_account.max' => 'Please reduce the bank_account because this section only hold 255 character',
            'phone_number.regex'=> 'Please follow the format of the phone number',
            'address.min' => 'Please put more detailed information about the restaurant location',
            'image.mimes' => 'The uploaded file must be in an image format'
        ]);

        $image = $request->file('image');

        $dateTime = now()->format('Ymd_His');

        $filename = $dateTime . '_' . $image->getClientOriginalName();

        $newPath = $request->file('image')->storeAs('public/restaurant_image', $filename);

        $user_id = Auth::id();

        // dd($newPath);

        $restaurant = Restaurant::create([
            'user_id' => $user_id,
            'name' => $request->restaurant_name,
            'description' => $request->description,
            'bank_account'=> $request->bank_account,
            'phone_number' => $request->phone_number,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'address' => $request->address,
            'image' => $newPath,
        ]);

        // same as bellow just another way to create it
        $id = auth()->id();

        User::where('id', $id)
            ->update([
                'has_restaurant' => 1,
            ]);

        // if (auth()->check()) {
        //     $user = auth()->user();
        //     $user->has_restaurant = 1;
        //     $user->save();
        // }

        // dd($user_id);

        return redirect()->route('owner.index');
    }

    public function profile()
    {
        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->opening_time);
        $formattedTimeOpening = $carbonDate->format('H:i');

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->closing_time);
        $formattedTimeClosing = $carbonDate->format('H:i');

        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();

        return view('owner.restaurant.profile')->with('restaurant', $restaurant)->with('formattedTimeOpening', $formattedTimeOpening)->with( 'formattedTimeClosing', $formattedTimeClosing);
    }

    public function activate(){

        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();

        Restaurant::where('id', $restaurant->id)
        ->update([
            'restaurant_opening_status' => 1,
        ]);

        return redirect()->route('owner.restaurant.profile')->with('restaurant', $restaurant);
    }

    public function deactivate(){
        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        Restaurant::where('id', $restaurant->id)
        ->update([
            'restaurant_opening_status' => 0,
        ]);
        return redirect()->route('owner.restaurant.profile')->with('restaurant', $restaurant);
    }

    public function editSave(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'restaurant_name' => ['required', 'max:255'],
            'description' => ['required', 'min:20', 'max:255'],
            'bank_account' => ['required', 'max:255'],
            'phone_number' => ['required', 'regex:/^\+?\d{7,15}$/', Rule::unique('restaurants')->ignore($restaurant->id)],
            'opening_time' => ['required', 'date_format:H:i', 'before_or_equal:closing_time'],
            'closing_time' => ['required', 'date_format:H:i'],
            'address' => ['required', 'min:15', 'max:255'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg'],
        ], [
            'opening_time.before_or_equal' => 'The opening time must be before or equal to the closing time.',
            'description.min' => 'Please put more detailed information about the restaurant description at least 20 words',
            'bank_account.max' => 'Please reduce the bank_account because this section only hold 255 character',
            'phone_number.regex'=> 'Please follow the format of the phone number',
            'address.min' => 'Please put more detailed information about the restaurant location at least 20 words',
            'image.mimes' => 'The uploaded file must be in an image format'
        ]);

        // dd($restaurant);


        $image = $restaurant->image;

        if ($request->hasFile('image')) {

            $imageNew = $request->file('image');

            $dateTime = now()->format('Ymd_His');

            $filename = $dateTime . '_' . $imageNew->getClientOriginalName();

            Storage::delete($restaurant->image);
            $image = $request->file('image')->storeAs('public/restaurant_image', $filename);
        }


        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        Restaurant::where('id', $restaurant->id)
        ->update([
            'name'=> $request->restaurant_name,
            'description'=> $request->description,
            'bank_account'=> $request->bank_account,
            'phone_number'=> $request->phone_number,
            'opening_time'=> $request->opening_time,
            'closing_time'=> $request->closing_time,
            'address'=> $request->address,
            'image'=> $image,
        ]);
        // return view('owner.restaurant.edit');
        return redirect('owner/restaurant/profile')->with('restaurant', $restaurant);
    }

}
