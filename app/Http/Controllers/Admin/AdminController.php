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
        $products = count(Product::all());

        return view('pages.seller.dashboard', compact('users', 'stores', 'products'));
    }
    public function users()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'admin');
        })->with('roles')->paginate(10);
        // dd($users);
        return view('pages.admin.users', compact('users'));
    }

    public function products()
    {
        $products = Product::paginate(10);
        return view('pages.admin.products', compact('products'));
    }
}
