<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ViewCounter;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChartController extends Controller
{
    //
    public function index(){
        session()->forget('last_url');

        $restaurant = Auth::user()->restaurant;
        $ReservationCounter = Reservation::where('restaurant_id', $restaurant->id)
                    ->whereIn('reservation_status', [3, 4, 5])
                    ->count();

        $startDate = Carbon::now()->subMonth(12);
        $endDate = Carbon::now()->addMonth(3);

        $RatingCounter = Feedback::where('restaurant_id', $restaurant->id)
                    ->count();


        $data = ViewCounter::where(function($query) use ($restaurant, $startDate, $endDate) {
            $query->where('restaurant_id', [$restaurant->id])
                  ->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->get()
        ->groupBy(function ($viewCounter) {
            return $viewCounter->created_at->format('Y-m');
        })
        ->sortKeys();



        $chartData = [];


        foreach ($data as $month => $count) {
            $chartData['categories'][] = date('F Y', strtotime($month));
            $chartData['data'][] = $count->count();
        }
        // dd($chartData);

        $data2 = Feedback::where('restaurant_id', [$restaurant->id])
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get()
        ->groupBy(function ($viewCounter) {
            return $viewCounter->created_at->format('Y-m');
        })
        ->sortKeys();

        // dd($data2);

        $chartData2 = [];


        foreach ($data2 as $month => $count) {
            $chartData2['categories'][] = date('F Y', strtotime($month));
            $chartData2['data'][] = $count->count();
        }

        $startDate3 = Carbon::now()->subMonth(12);
        $endDate3 = Carbon::now()->addMonth(3);

        $data3 = Reservation::where('restaurant_id', $restaurant->id)
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

        //  dd($chartData3);

        return view('owner.charts.index',compact('restaurant','ReservationCounter','RatingCounter','chartData','chartData2','chartData3'));
    }
}
