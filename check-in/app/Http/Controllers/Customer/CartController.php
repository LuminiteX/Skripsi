<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\CartDetail;
use App\Models\CartHeader;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function index(){
        $user = auth()->user();
        $reservations = Reservation::where('user_id', $user->id)
                        ->where('reservation_status', 0)
                        ->paginate(5);

        session()->forget('last_url_customer');

        return view('customer.cart.cart-list', compact('user','reservations'));
    }

    public function detail(Reservation $reservation){

        $cart_header = $reservation->cart_header;
        $cart_details = $reservation->cart_header->cart_detail;

        return view('customer.cart.cart-detail-list', compact('reservation','cart_details','cart_header'));
    }

    public function cancel(Reservation $reservation){
        $reservation->update([
            'reservation_status'=> 7,
        ]);

        $user = auth()->user();
        $reservations = Reservation::where('user_id', $user->id)
                        ->where('reservation_status', 0)
                        ->paginate(5);


        return view('customer.cart.cart-list', compact('user','reservations'));

    }

    public function store(Request $request, Restaurant $restaurant, $reservation){

        $request->validate([
            'qty' => ['required', 'integer', 'min:1']
        ]);

        $reservation = Reservation::where('id', $reservation)->first();
        // dd($reservation->cart_header->id);
        // $cart_header = CartHeader::where('reservation_id', $reservation->id)->first();
        $menu = Menu::find($request->menu_id);
        $menu_id = $request->menu_id;
        $qty = $request->qty;


        $cartDetail = CartDetail::where('menu_id', $menu_id)
        ->where('cart_header_id', $reservation->cart_header->id)
        ->first();

        if ($cartDetail) {
            // if the cart detail already exists, update the qty and sub_total
            $cartDetail->quantity += $qty;
            $cartDetail->subtotal += $menu->price * $qty;
            $cartDetail->save();
        } else {
            // if the cart detail does not exist, create a new one
            $cartDetail = new CartDetail;
            $cartDetail->cart_header_id = $reservation->cart_header->id;
            $cartDetail->menu_id = $menu_id;
            $cartDetail->quantity = $qty;
            $cartDetail->subtotal = $cartDetail->menu->price * $qty;
            $cartDetail->save();
        }


        $total = CartDetail::where('cart_header_id', $reservation->cart_header->id)->sum('subtotal');
        CartHeader::updateOrCreate(
        ['reservation_id' => $reservation->id],
        ['total' => $total]
        );

        return to_route('menu.index', ['restaurant' => $restaurant->id, 'reservation' => $reservation->id]);
    }

    public function storeFromCategory(Request $request, Category $category, $reservation){

        $request->validate([
            'qty' => ['required']
        ]);

        $reservation = Reservation::where('id', $reservation)->first();
        // dd($reservation->cart_header->id);
        // $cart_header = CartHeader::where('reservation_id', $reservation->id)->first();
        $menu = Menu::find($request->menu_id);
        $menu_id = $request->menu_id;
        $qty = $request->qty;


        $cartDetail = CartDetail::where('menu_id', $menu_id)
        ->where('cart_header_id', $reservation->cart_header->id)
        ->first();

        if ($cartDetail) {
            // if the cart detail already exists, update the qty and sub_total
            $cartDetail->quantity += $qty;
            $cartDetail->subtotal += $menu->price * $qty;
            $cartDetail->save();
        } else {
            // if the cart detail does not exist, create a new one
            $cartDetail = new CartDetail;
            $cartDetail->cart_header_id = $reservation->cart_header->id;
            $cartDetail->menu_id = $menu_id;
            $cartDetail->quantity = $qty;
            $cartDetail->subtotal = $cartDetail->menu->price * $qty;
            $cartDetail->save();
        }


        $total = CartDetail::where('cart_header_id', $reservation->cart_header->id)->sum('subtotal');
        CartHeader::updateOrCreate(
        ['reservation_id' => $reservation->id],
        ['total' => $total]
        );

        return to_route('menu.sort.by', ['category' => $category->id, 'reservation' => $reservation->id]);
    }

    public function cartDetailUpdate(Menu $menu, Reservation $reservation, CartDetail $cart_detail){
        $categories = Category::join('category_menu', 'categories.id', '=', 'category_menu.category_id')
                      ->where('category_menu.menu_id', $menu->id)
                      ->where('categories.restaurant_id', $menu->restaurant_id)
                      ->first();


        return view('customer.cart.cart-edit',compact('menu','categories','reservation', 'cart_detail'));
    }

    public function saveUpdate(Request $request, Reservation $reservation, $cart_detail){
        $request->validate([
            'qty' => ['required', 'integer', 'min:1']
        ]);


        $cart_detail = CartDetail::where('id', $cart_detail)->first();
        $cart_header = CartHeader::where('id', $cart_detail->cart_header_id)->first();
        // dd($cart_detail);

        // $cart_header = $cart_detail->cart_header;

        $menu = Menu::find($request->menu_id);
        $id = $cart_detail->id;
        CartDetail::where('id', $id)->update([
            'quantity' => $request->qty,
            'subtotal' => $request->qty * $menu->price
        ]);

        $total = CartDetail::where('cart_header_id', $reservation->cart_header->id)->sum('subtotal');
        CartHeader::updateOrCreate(
        ['reservation_id' => $reservation->id],
        ['total' => $total]
        );

        return to_route('cart.list.detail', $reservation->id);
    }

    public function deleteItem(Reservation $reservation, $cart_detail){
        CartDetail::where('id', $cart_detail)->delete();

        $total = CartDetail::where('cart_header_id', $reservation->cart_header->id)->sum('subtotal');
        CartHeader::updateOrCreate(
        ['reservation_id' => $reservation->id],
        ['total' => $total]
        );
        return to_route('cart.list.detail', $reservation->id);
    }

    public function confirmTransaction(Reservation $reservation){

        $cart_header = $reservation->cart_header;

        Reservation::where('id', $reservation->id)->update([
            'reservation_status' => 1,
        ]);

        CartHeader::where('id', $cart_header->id)->update([
            'cart_status' => 1,
        ]);

        return to_route('reservations.list');
    }

}
