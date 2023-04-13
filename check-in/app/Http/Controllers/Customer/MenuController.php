<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $menus = $restaurant->menus()->get();

        $categories = Category::where('restaurant_id', $restaurant->id)->paginate(3);
        // $categories = $restaurant->category()->paginate(5);

        return view('customer.menus.index', compact('menus','categories'));
    }

    public function sortByCategory(Category $category){
        $menus = $category->menus()->get();
        $restaurant = $category->restaurant()->first();
        // dd($restaurant);
        return view('customer.menus.sort-by-category', compact('menus','restaurant'));
    }

    public function menuDetail(Menu $menu) {

        $categories = Category::join('category_menu', 'categories.id', '=', 'category_menu.category_id')
                      ->where('category_menu.menu_id', $menu->id)
                      ->where('categories.restaurant_id', $menu->restaurant_id)
                      ->first();
        
        return view('customer.menus.menu-detail',compact('menu','categories'));
    }
}
