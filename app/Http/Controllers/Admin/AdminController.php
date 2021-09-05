<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function index(){
        $users = count(User::all());
        $stores = count(Store::all());

        return view('pages.seller.dashboard', compact('users', 'stores'));
    }
    public function users()
    {
        $users = User::all();
        return view('pages.admin.dashboard', compact('users'));
    }

    public function products()
    {
        $products = Product::all();
        return view('pages.admin.products', compact('products'));
    }
}
