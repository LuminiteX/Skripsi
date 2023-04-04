<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'regex:/^\+?\d{7,15}$/', 'unique:users'],
            'address' => ['required', 'string', 'min:20'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg'],
            'is_special_user' => ['required']

        ],  [
            'is_special_user.required' => 'Please pick one of the role',
        ]);

        // $image = $request->file('image')->store('public/menus');
        $image = $request->file('image');

        $dateTime = now()->format('Ymd_His');

        $filename = $dateTime . '_' . $image->getClientOriginalName();

        $newPath = $request->file('image')->storeAs('public/picture', $filename);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'image' => $newPath,
            'is_special_user' => $request->is_special_user,
        ]);



        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);

        if (auth()->user()->is_special_user == 0) {
            return redirect(RouteServiceProvider::HOME);
        }
        if (auth()->user()->is_special_user == 1) {
            return redirect(RouteServiceProvider::HOMEOwner);
        }
        if (auth()->user()->is_special_user == 2) {
            return redirect(RouteServiceProvider::HOMEAdmin);
        }
    }
}
