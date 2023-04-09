<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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

    public function profile(){
        $user = Auth::user();
        return view('owner.profile.index')->with('user', $user);
    }

    public function edit(){
        $user = Auth::user();
        return view('owner.profile.edit')->with('user', $user);
    }

    public function editSave(Request $request){
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'regex:/^\+?\d{7,15}$/', Rule::unique('users')->ignore($user->id)],
            'address' => ['required', 'string', 'min:20'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg'],

        ],[
            'phone_number.regex'=> 'Please follow the format of the phone number',
            'address.min' => 'Please put more detailed information about the restaurant location at least 20 words',
            'image.mimes' => 'The uploaded file must be in an image format',
        ]);

        $image = $user->image;

        if ($request->hasFile('image')) {

            $imageNew = $request->file('image');

            $dateTime = now()->format('Ymd_His');

            $filename = $dateTime . '_' . $imageNew->getClientOriginalName();

            Storage::delete($user->image);

            $image = $request->file('image')->storeAs('public/picture', $filename);
        }

        User::where('id', $user->id)
        ->update([
            'name'=> $request->name,
            'phone_number'=> $request->phone_number,
            'address'=> $request->address,
            'image'=> $image,
        ]);

        return redirect()->route('owner.profile')->with('user', $user);
    }
}
