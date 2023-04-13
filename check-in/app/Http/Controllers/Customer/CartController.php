<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function index(){
        $user = auth()->user();
        $reservations = Reservation::where('user_id', $user->id)
                        ->where('reservation_status', 0)
                        ->paginate(5);
        
        return view('customer.cart.cart-list', compact('user','reservations'));
    }
}
