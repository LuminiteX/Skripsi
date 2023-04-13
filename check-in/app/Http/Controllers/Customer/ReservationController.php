<?php

namespace App\Http\Controllers\Customer;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\CartHeader;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Menu;
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
        // dd($restaurant);
        $validated = $request->validate([
            'guest_number' => ['required'],
            'reservation_date' => ['required', 'date', new DateBetween, new TimeBetween2($restaurant->opening_time, $restaurant->closing_time)],
        ]);

        $validated['user_id'] = $user->id;
        $validated['restaurant_id'] = $restaurant->id;

        // dd($validated);

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

        // dd(session('reservation'));

        return to_route('reservations.step.two');
    }
    public function stepTwo(Request $request)
    {

        $reservation = $request->session()->get('reservation');
        $restaurant = Restaurant::where('id', [$reservation->restaurant_id])->first();

        // $res_table_ids = Reservation::orderBy('res_date')->get()->filter(function ($value) use ($reservation) {
        //     return $value->res_date->format('Y-m-d') == $reservation->res_date->format('Y-m-d');
        // })->pluck('table_id');

        //testing newest validation this time it is between after 1 hour and before 1 hour of the reservation time in reservation table
        $res_table_ids = Reservation::orderBy('reservation_date')
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

            // dd($tables);

        return view('customer.reservation.step-two', compact('reservation', 'tables','restaurant'));
    }

    public function storeStepTwo(Request $request, Restaurant $restaurant)
    {
        // dd("Hit without menu");

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
        $reservation['reservation_status'] = 2;
        $reservation->save();

        return to_route('thankyou', $restaurant->id);
    }

    public function storeStepTwoWithMenu(Request $request, Restaurant $restaurant)
    {
        // dd("Hit with menu");
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
            'cart_status' => 0,
            'total' => 0,
        ]);

        $menus = $restaurant->menus()->get();

        $categories = Category::where('restaurant_id', $restaurant->id)->paginate(3);

        return to_route('menu.index', ['restaurant' => $restaurant->id, 'reservation' => $reservation->id]);
    }
}
