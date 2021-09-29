<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole("seller")) {
            $store =  $user->stores;
            $products= count($store->products);
            return view('pages.seller.dashboard', compact('products'));
           
        }else{
            return back();
        }
    }
    public function productComments($id){
        
    }
}
