<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Reservation $reservation){
        $currentUrl = url()->current();
        $previousUrl = url()->previous();

        if ($currentUrl !== $previousUrl) {
            session()->put('last_url_customer', $previousUrl);
        }
        return view('customer.feedback.feedback', compact('reservation'));
    }

    public function store(Request $request, Reservation $reservation){
        // dd($request->rating);

        $request->validate([
            'rating' => 'required',
        ],['rating.required' => 'Please give us rating so we can improve our service']);


        Feedback::create([
            'reservation_id'=> $reservation->id,
            'restaurant_id'=> $reservation->restaurant_id,
            'user_id' => $reservation->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $averageRating = Feedback::where('restaurant_id', $reservation->restaurant_id)
        ->avg('rating');
        $averageRating = round($averageRating * 2) / 2;
        // dd($averageRating);

        $restaurant = Restaurant::findOrFail($reservation->restaurant_id);
        $restaurant->update([
            'rating' => $averageRating
        ]);

        $reservation->reservation_status = 5;
        $reservation->save();

        return to_route('reservations.history');

    }
}
