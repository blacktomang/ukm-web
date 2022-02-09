<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrafikController extends Controller
{
    public function grafik()
    {
        $stores = Store::all();
        $x_y = [];
        $p = [];
        foreach ($stores as $key => $store) {
            if ($store->products) {
                $products = $store->products;
                $prevTotal = 0;
                foreach ($products as $key => $product) {
                    $prevRate = $product->rates;
                    for ($i = 0; $i < count($prevRate); $i++) {
                        $prevTotal += $prevRate[$i]->value;
                    }
                    // $prevAverage = $prevTotal / count($prevRate);
                    // $user_click = floatval($product->rate - $prevAverage);
                }
                array_push($x_y, [$prevTotal,  $store->store_name]);
            }else{
                array_push($x_y, [0,  $store->store_name]);
            }
        }

        foreach ($stores as $store) {
            if ($store->products) {
                $products = $store->products;
                $prevTotal = 0;
                foreach ($products as $product) {
                    $prevTotal += $product->reviews()->count();
                }
                array_push($p, $prevTotal);
            }else{
                array_push($p, 0);
            }
        }

        return view('pages.admin.grafik.index', compact(['x_y', 'p']));
    }
}
