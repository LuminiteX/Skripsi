<?php

namespace App\Http\Controllers\Customer;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\CartHeader;
use App\Models\Restaurant;
use App\Rules\DateBetween;
use App\Rules\TimeBetween2;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{


    public function stepOne(Request $request, Restaurant $restaurant)
    {
        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->opening_time);
        $formattedTimeOpening = $carbonDate->format('H:i');

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->closing_time);
        $formattedTimeClosing = $carbonDate->format('H:i');


        $reservation = $request->session()->get('reservation');
        list($hourStart, $minuteStart) = explode(':', $formattedTimeOpening);
        $min_date = Carbon::tomorrow()->setTime($hourStart, $minuteStart, 0);

        list($hourEnd, $minuteEnd) = explode(':', $formattedTimeClosing);
        $max_date = Carbon::now()->addMonth(3)->setTime($hourEnd, $minuteEnd, 0);
        return view('customer.reservation.step-one', compact('reservation', 'min_date', 'max_date','restaurant','formattedTimeOpening','formattedTimeClosing'));
    }

    public function storeStepOne(Request $request)
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', [$request->restaurant_id])->first();

        $validated = $request->validate([
            'guest_number' => ['required'],
            'reservation_date' => ['required', 'date', new DateBetween, new TimeBetween2($restaurant->opening_time, $restaurant->closing_time)],
        ]);

        $validated['user_id'] = $user->id;
        $validated['restaurant_id'] = $restaurant->id;

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $request->session()->forget('reservation');
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }


        return to_route('reservations.step.two');
    }
    public function stepTwo(Request $request)
    {

        $reservation = $request->session()->get('reservation');
        $restaurant = Restaurant::where('id', [$reservation->restaurant_id])->first();

        //testing newest validation this time it is between after 1 hour and before 1 hour of the reservation time in reservation table
        $res_table_ids = Reservation::orderBy('reservation_date')
            ->whereNotIn('reservation_status', [5, 6, 7])
            ->get()
            ->filter(function ($value) use ($reservation) {
                $start_time = $reservation->reservation_date->subHour(2);
                $end_time = $reservation->reservation_date->addHour(2);

                return  $value->reservation_date->format('Y-m-d') == $reservation->reservation_date->format('Y-m-d') &&
                    $value->reservation_date->between($start_time, $end_time);
            })->pluck('table_id');



        $tables = Table::where('status', TableStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->where('restaurant_id', $reservation->restaurant_id)
            ->whereNotIn('id', $res_table_ids)->get();

        return view('customer.reservation.step-two', compact('reservation', 'tables','restaurant'));
    }

    public function storeStepTwo(Request $request, Restaurant $restaurant)
    {

        $validated = $request->validate([
            'table_id' => ['required']
        ]);

        $reservation = $request->session()->get('reservation');

        $restaurant = Restaurant::where('id', [$restaurant->id])->first();


        //testing newest validation this time it is between after 2 hour and before 2 hour of the reservation time in reservation table
        $res_table_ids = Reservation::orderBy('reservation_date')
            ->get()
            ->whereNotIn('reservation_status', [5, 6, 7])
            ->filter(function ($value) use ($reservation) {
                $start_time = $reservation->reservation_date->subHour(2);
                $end_time = $reservation->reservation_date->addHour(2);
                return  $value->reservation_date->format('Y-m-d') == $reservation->reservation_date->format('Y-m-d') &&
                    $value->reservation_date->between($start_time, $end_time);
            })->pluck('table_id');

        if ($res_table_ids->contains($validated['table_id'])) {
            return back()->with('error', 'The selected table has already been reserved by someone else. Please choose another one.');
        }

        $reservation->fill($validated);
        $reservation['reservation_status'] = 2;
        $reservation->save();

        return to_route('reservations.list');
    }

    public function storeStepTwoWithMenu(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'table_id' => ['required']
        ]);
        $reservation = $request->session()->get('reservation');

        $restaurant = Restaurant::where('id', [$restaurant->id])->first();

        //testing newest validation this time it is between after 2 hour and before 2 hour of the reservation time in reservation table
        $res_table_ids = Reservation::orderBy('reservation_date')
            ->get()
            ->filter(function ($value) use ($reservation) {
                $start_time = $reservation->reservation_date->subHour(2);
                $end_time = $reservation->reservation_date->addHour(2);
                return  $value->reservation_date->format('Y-m-d') == $reservation->reservation_date->format('Y-m-d') &&
                    $value->reservation_date->between($start_time, $end_time);
            })->pluck('table_id');

        if ($res_table_ids->contains($validated['table_id'])) {
            return back()->with('error', 'The selected table has already been reserved by someone else. Please choose another one.');
        }

        $reservation->fill($validated);
        $reservation['reservation_status'] = 0;
        $reservation->save();

        // dd($reservation->id);
        CartHeader::create([
            'reservation_id' => $reservation->id,
            'restaurant_id'=> $reservation->restaurant_id,
            'total' => 0,
        ]);


        return to_route('menu.index', ['restaurant' => $restaurant->id, 'reservation' => $reservation->id]);
    }

    public function index(){
        $user = auth()->user();
        $reservations = Reservation::where('user_id', $user->id)
                        ->whereIn('reservation_status', [1,2,3])
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);

        $lastPage = session()->get('last_url_customer');
        session()->forget('last_url_customer');

        if ($lastPage && $lastPage !== $reservations->url(1)) {
            return redirect($lastPage);
        }

        return view('customer.reservation.reservation-list', compact('user','reservations'));
    }

    public function cancel(Reservation $reservation){
        $reservation->update([
            'reservation_status'=> 7,
        ]);

        return to_route('reservations.list');
    }

    public function reservationDetailWithMenu(Reservation $reservations){
        $currentUrl = url()->current();
        $previousUrl = url()->previous();

        if ($currentUrl !== $previousUrl) {
            session()->put('last_url_customer', $previousUrl);
        }

        return view('customer.reservation.reservation-detail-with-menu', compact('reservations'));
    }

    public function history(){
        $user = auth()->user();
        $reservations = Reservation::where('user_id', $user->id)
                        ->whereIn('reservation_status', [4,5,6,7])
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);

        $lastPage = session()->get('last_url_customer');
        session()->forget('last_url_customer');

        if ($lastPage && $lastPage !== $reservations->url(1)) {
            return redirect($lastPage);
        }

        return view('customer.reservation.reservation-history', compact('user','reservations'));
    }

    public function reservationDetailWithoutMenu(Reservation $reservations){
        $currentUrl = url()->current();
        $previousUrl = url()->previous();

        if ($currentUrl !== $previousUrl) {
            session()->put('last_url_customer', $previousUrl);
        }

        return view('customer.reservation.reservation-detail-without-menu', compact('reservations'));
    }

    public function reservationDetailUploadReceipt(Reservation $reservations){
        $currentUrl = url()->current();
        $previousUrl = url()->previous();

        if ($currentUrl !== $previousUrl) {
            session()->put('last_url_customer', $previousUrl);
        }

        return view('customer.reservation.reservation-detail-upload-receipt', compact('reservations'));
    }



    public function uploadProof(Request $request, Reservation $reservation){
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif']
        ], [
            'image.required' => 'Please upload an image',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a JPEG, PNG, JPG, or GIF',
        ]);

        $cart_header = $reservation->cart_header;
        $image = $request->file('image')->store('public/receipt');

        CartHeader::where('id', $cart_header->id)
            ->update([
                'image' => $image,
            ]);

        $reservation->update([
            'reservation_status'=> 2,
        ]);

        session()->flash('message', 'The upload transaction for the reservation in restaurant ' .$reservation->restaurant->name. ' is successfull status has been change');
        $lastPage = session()->get('last_url_customer');
        session()->forget('last_url_customer');

        return redirect($lastPage);
    }


}
