<?php

namespace App\Http\Controllers\Customer;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\ViewCounter;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Comment;
use App\Rules\DateBetween;
use App\Rules\TimeBetween2;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // public function index()
    // {
    //     $restaurants = Restaurant::where('restaurant_status', 1)
    //         ->where('restaurant_opening_status', 1)
    //         ->paginate(6);

    //     return view('customer.reservation.index', compact('restaurants'));
    // }

    // public function search(Request $request)
    // {
    //     if ($request->search) {
    //         $restaurants = Restaurant::where('name', 'LIKE', '%' . $request->search . '%')->where('restaurant_status', 1)
    //         ->where('restaurant_opening_status', 1)
    //         ->latest()->paginate(6)->withQueryString();
    //         return view('customer.reservation.index', compact('restaurants'));
    //     } else {
    //         return redirect()->back()->with('message', 'The search is empty please fill in restaurant name to search the restaurant');
    //     }
    // }

    // public function detail(Restaurant $restaurants){
    //     $restaurants->increment('view');
    //     ViewCounter::create([
    //         'restaurant_id'=> $restaurants->id,
    //     ]);

    //     $menus = Menu::where('restaurant_id', $restaurants->id)->paginate(3);

    //     $startDate3 = Carbon::now()->subMonth(12);
    //     $endDate3 = Carbon::now()->addMonth(3);

    //     $data3 = Reservation::where('restaurant_id', $restaurants->id)
    //     ->whereIn('reservation_status', [3, 4, 5])
    //     ->whereBetween('reservation_date', [$startDate3, $endDate3])
    //     ->get()
    //     ->groupBy(function ($viewCounter) {
    //         return $viewCounter->reservation_date->format('Y-m');
    //     })
    //     ->sortKeys();

    //     $chartData3 = [];


    //     foreach ($data3 as $month => $count) {
    //         $chartData3['categories'][] = date('F Y', strtotime($month));
    //         $chartData3['data'][] = $count->count();
    //     }

    //     $comments = Comment::where('restaurant_id', $restaurants->id)->where('parent', 0)->orderBy('created_at', 'desc')->get();

    //     // dd($restaurants);

    //     return view('customer.reservation.restaurant', compact('restaurants','menus','chartData3','comments'));
    // }

    // public function send(Request $request, Restaurant $restaurant){
    //     $request->validate([
    //         'comment' => 'required',
    //     ]);

    //     $user = Auth::user();

    //     Comment::create([
    //         'restaurant_id'=>$restaurant->id,
    //         'user_id' => $user->id,
    //         'comment' =>$request->comment
    //     ]);

    //     return back();
    // }

    // public function reply(Request $request, Restaurant $restaurant){
    //     $request->validate([
    //         'comment' => 'required',
    //     ]);
    //     $user = Auth::user();
    //     // dd($request->comment_id);
    //     Comment::create([
    //         'restaurant_id'=>$restaurant->id,
    //         'user_id' => $user->id,
    //         'comment' =>$request->comment,
    //         'parent' => $request->comment_id
    //     ]);

    //     return back();
    // }

    // public function destroy(Comment $comments){

    //     if($comments->parent == 0){
    //         Comment::whereIn('parent',[$comments->id])->delete();
    //     }
    //     $comments->delete();

    //     return back();
    // }

    public function stepOne(Request $request, Restaurant $restaurant)
    {
        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->opening_time);
        $formattedTimeOpening = $carbonDate->format('H:i');

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->closing_time);
        $formattedTimeClosing = $carbonDate->format('H:i');

        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addMonth(3);
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
                    $value->reservations_date->between($start_time, $end_time);
            })->pluck('table_id');

        // dd($res_table_ids);

        $tables = Table::where('status', TableStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->where('restaurant_id', $reservation->restaurant_id)
            ->whereNotIn('id', $res_table_ids)->get();

            // dd($tables);

        return view('customer.reservation.step-two', compact('reservation', 'tables','restaurant'));
    }

    public function storeStepTwo(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'table_id' => ['required']
        ]);
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();
        $request->session()->forget('reservation');

        return to_route('thankyou');
    }
}
