<?php

namespace App\Http\Controllers\Owner;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\CartHeader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Auth::user()->restaurant;
        $reservations = Reservation::where('restaurant_id', $restaurant->id)
                    ->orderBy('reservation_date', 'asc')
                    ->paginate(10);

        return view('owner.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Reservation $reservation)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        if($reservation->cart_header){
            return view('owner.reservations.view_with_menu', compact('reservation'));
        }

        return view('owner.reservations.view', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $currentRestaurantId = Auth::user()->restaurant->id;
        $tables = Table::where('restaurant_id', $currentRestaurantId)->where('status', TableStatus::Available)->get();
        return view('owner.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, Reservation $reservation)
    {

        $restaurant = Auth::user()->restaurant;

        $table = Table::where('id', $request->table_id)
                    ->where('restaurant_id', $restaurant->id)
                    ->firstOrFail();

        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        $request_date = Carbon::parse($request->reservation_date);
        $reservations = $table->reservations()->whereNotIn('reservation_status', [5, 6])->where('id', '!=', $reservation->id)->get();

        foreach ($reservations as $res) {
            if ($res->reservation_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                $start = $request_date->copy()->subHours(2);
                $end = $request_date->copy()->addHours(2);

                if ($res->reservation_date->between($start, $end)) {
                    return back()->with('warning', 'This table is reserved for this exact date and time please choose another date or time.');
                }

            }
        }

        $reservation->update($request->validated());

        Reservation::where('id', $reservation->id)
            ->update([
                'reservation_status' => 3,
            ]);
        return to_route('owner.reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
