<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole("seller")) {
            $store =  $user->stores;
            if ($store!=null) {
                $products= count($store->products);
                return view('pages.seller.dashboard', compact('products'));
                # code...
            }else{
                $request->session()->flash('errorLo', 'Anda belum mendaftarkan UKM anda');
                return view('pages.seller.index', compact('user'));
            }
        }else{
            return back();
        }
    }
    public function productComments($id){
        
    }
}
