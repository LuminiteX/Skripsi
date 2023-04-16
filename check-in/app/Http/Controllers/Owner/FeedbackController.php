<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(){
        session()->forget('last_url');

        $restaurant = Auth::user()->restaurant;
        $feedbacks = Feedback::where('restaurant_id', $restaurant->id)->paginate(5);


        return view('owner.feedback.index', compact('feedbacks'));
    }
    public function rateAsc(){

        $restaurant = Auth::user()->restaurant;
        $feedbacks = Feedback::where('restaurant_id', $restaurant->id)
                    ->orderBy('rating', 'asc')
                    ->paginate(5);

        return view('owner.feedback.index', compact('feedbacks'));
    }
    public function rateDesc(){

        $restaurant = Auth::user()->restaurant;
        $feedbacks = Feedback::where('restaurant_id', $restaurant->id)
                    ->orderBy('rating', 'desc')
                    ->paginate(5);

        return view('owner.feedback.index', compact('feedbacks'));
    }
    public function dateAsc(){

        $restaurant = Auth::user()->restaurant;
        $feedbacks = Feedback::where('restaurant_id', $restaurant->id)
                    ->orderBy('created_at', 'asc')
                    ->paginate(5);

        return view('owner.feedback.index', compact('feedbacks'));
    }

    public function dateDesc(){

        $restaurant = Auth::user()->restaurant;
        $feedbacks = Feedback::where('restaurant_id', $restaurant->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);

        return view('owner.feedback.index', compact('feedbacks'));
    }

}
