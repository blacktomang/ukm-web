<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrafikController extends Controller
{
    public function grafik()
    {
        $products = Product::all();
        $x_y = [];
        foreach ($products as $key => $product) {
            $prevRate = $product->rates;
            $prevTotal = 0;
            for ($i = 0; $i < count($prevRate); $i++) {
                $prevTotal += $prevRate[$i]->value;
            }
            if (count($prevRate)>0) {
                $prevAverage = $prevTotal / count($prevRate);
                $user_click = floatval($product->rate - $prevAverage);
                array_push($x_y, [$prevTotal,  $product->stores->store_name]);
                # code...
            }
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
        // dd($x_y);
        return view('pages.admin.grafik.index', compact('x_y'));
    }
}
