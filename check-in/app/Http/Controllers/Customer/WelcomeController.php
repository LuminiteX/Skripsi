<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\Artisan::call('storage:link');
        return view('customer.home');
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
