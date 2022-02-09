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
            # code...
            // if (count($prevRate)>0) {
            // }else{

            // }
            // $updatedProduct = Product::find($id);
            // $rate_product = $updatedProduct->rates;
            // $total_rate = 0;
            // for ($i = 0; $i < count($rate_product); $i++) {
            //     $total_rate += $rate_product[$i]->value;
            // }
            // $newAverage = $total_rate / count($rate_product);
            // $newRate = $newAverage + $user_click;
            // $product->update([
            //     'rate' => $newRate,
            // ]);
        }
        return view('pages.admin.grafik.index', compact('x_y'));
    }
}
