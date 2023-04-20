<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function sortByCategory(Category $category, Reservation $reservation){
        $menus = $category->menus()->get();
        $restaurant = $category->restaurant()->first();
        // dd($restaurant);
        return view('customer.menus.sort-by-category', compact('menus','restaurant','reservation','category'));
    }

    public function menuDetailFromCategory(Menu $menu, Reservation $reservation) {

        $categories = Category::join('category_menu', 'categories.id', '=', 'category_menu.category_id')
                      ->where('category_menu.menu_id', $menu->id)
                      ->where('categories.restaurant_id', $menu->restaurant_id)
                      ->first();

        return view('customer.menus.menu-detail-from-category',compact('menu','categories','reservation'));
    }
}
