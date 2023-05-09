<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\CartHeader;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController2 extends Controller
{
    public function reject(Reservation $reservation){
        $reservation->update([
            'reservation_status'=> 6,
        ]);

        return back()->with('danger', 'Reservation has been changed into rejected');
    }
    public function notEligible(Reservation $reservation){

        $cartHeader = $reservation->cart_header;
        if ($cartHeader->image) {
            Storage::delete($cartHeader->image);
            CartHeader::where('id', $cartHeader->id)
            ->update([
                'image' => null,
            ]);
        }

        $reservation->update([
            'reservation_status'=> 1,
        ]);

        // session()->forget('last_url');
        // return to_route('owner.reservations.index')->with('success', 'Reservation is not eligible, reverting to the previous status, and need to upload the proof of the transaction again');

        session()->flash('success', 'Reservation is not eligible, reverting to the previous status, and need to upload the proof of the transaction again');
        $lastPage = session()->get('last_url');
        session()->forget('last_url');

        return redirect($lastPage);
    }

    public function finish(Reservation $reservation){
        Reservation::where('id', $reservation->id)
            ->update([
                'reservation_status' => 4,
            ]);

        return back()->with('success', 'Reservation has been changed into finish');
    }

    public function sortByStatus(){
        $restaurant = Auth::user()->restaurant;
        $reservations = Reservation::where('restaurant_id', $restaurant->id)
                    ->orderBy('reservation_status', 'asc')
                    ->paginate(10);
        return view('owner.reservations.index', compact('reservations'));
    }

    public function sortByDateNowUntilFuture(){
        $restaurant = Auth::user()->restaurant;
        $now = Carbon::now();
        $threeMonthsLater = $now->copy()->addMonths(3);

        $reservations = Reservation::where('restaurant_id', $restaurant->id)
                ->where('reservation_date', '>=', $now)
                ->where('reservation_date', '<=', $threeMonthsLater)
                ->orderBy('reservation_date', 'asc')
                ->paginate(10);
        return view('owner.reservations.index', compact('reservations'));
    }

    public function sortByGuestNumber(){
        $restaurant = Auth::user()->restaurant;
        $reservations = Reservation::where('restaurant_id', $restaurant->id)
                    ->orderBy('guest_number', 'asc')
                    ->paginate(10);
        return view('owner.reservations.index', compact('reservations'));
    }

    public function sortByDateDesc(){
        $restaurant = Auth::user()->restaurant;
        $reservations = Reservation::where('restaurant_id', $restaurant->id)
                        ->orderBy('reservation_date', 'desc')
                        ->paginate(10);

        return view('owner.reservations.index', compact('reservations'));
    }
}
