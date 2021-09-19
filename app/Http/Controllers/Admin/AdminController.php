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
        return view('pages.admin.users', compact('users'));
    }

    public function products()
    {
        $products = Product::paginate(10);
        // $products =  Product::orderBy('rate', 'desc')->get();
        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['product_price'] = Product::rupiah($products[$i]['product_price']);
            $rates = 0;
            $rate_model_count = 0;
            $rate_data = $products[$i]->rates;
            //    dd($rate_data[$i]->value);
            if (count($rate_data) > 0) {
                for ($j = 0; $j < count($rate_data); $j++) {
                    $rates += $rate_data[$j]->value;
                    $rate_model_count += 1;
                }
                $products[$i]['rates'] = floor($rates / $rate_model_count);
                # code...
            }
            $products[$i]['reviews'] = count($products[$i]->reviews);
        }
        // return view('products', compact('products'));
        return view('pages.admin.products', compact('products'));
    }
    public function stores()
    {
        $stores = Store::paginate(10);
        return view('pages.admin.stores', compact('stores'));
    }
}
