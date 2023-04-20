<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ViewCounter;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    public function index()
    {
        session()->forget('last_url_customer');

        $restaurants = Restaurant::where('restaurant_status', 1)
            ->where('restaurant_opening_status', 1)
            ->paginate(6);

        return view('customer.reservation.index', compact('restaurants'));
    }

    public function search(Request $request)
    {
        if ($request->search) {
            $restaurants = Restaurant::where('name', 'LIKE', '%' . $request->search . '%')->where('restaurant_status', 1)
            ->where('restaurant_opening_status', 1)
            ->latest()->paginate(6)->withQueryString();
            return view('customer.reservation.index', compact('restaurants'));
        } else {
            return redirect()->back()->with('message', 'The search is empty please fill in restaurant name to search the restaurant');
        }
    }

    public function detail(Restaurant $restaurants){

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurants->opening_time);
        $formattedTimeOpening = $carbonDate->format('H:i');

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurants->closing_time);
        $formattedTimeClosing = $carbonDate->format('H:i');

        $restaurants->increment('view');
        ViewCounter::create([
            'restaurant_id'=> $restaurants->id,
        ]);

        $menus = Menu::where('restaurant_id', $restaurants->id)->paginate(3);

        $startDate3 = Carbon::now()->subMonth(12);
        $endDate3 = Carbon::now()->addMonth(3);

        $data3 = Reservation::where('restaurant_id', $restaurants->id)
        ->whereIn('reservation_status', [3, 4, 5])
        ->whereBetween('reservation_date', [$startDate3, $endDate3])
        ->get()
        ->groupBy(function ($viewCounter) {
            return $viewCounter->reservation_date->format('Y-m');
        })
        ->sortKeys();

        $chartData3 = [];


        foreach ($data3 as $month => $count) {
            $chartData3['categories'][] = date('F Y', strtotime($month));
            $chartData3['data'][] = $count->count();
        }

        $comments = Comment::where('restaurant_id', $restaurants->id)->where('parent', 0)->orderBy('created_at', 'desc')->get();

        // dd($restaurants);

        return view('customer.reservation.restaurant', compact('restaurants','menus','chartData3','comments','formattedTimeOpening','formattedTimeClosing'));
    }

}
