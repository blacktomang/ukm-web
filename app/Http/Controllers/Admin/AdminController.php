<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Review;
use App\Models\Store;
use App\Models\StoreImage;
use App\Models\User;
use Hamcrest\Type\IsInteger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{


    public function index(){
        $userss = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'admin');
        })->with('roles')->get();
        $users = count($userss);
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
    public function delete_user($id){
        $user = User::find($id);
        try {
            if (!is_integer($user->stores)) {
                $store = $user->stores;
                $products = $store->products;
                if ($store == null || $products==null) {
                    $user->delete();
                    return response()->json([
                        'status' => true,
                        'message' => [
                            'head' => 'Sukses',
                            'body' => "Seller $user->name dihapus"
                        ]
                    ], 200);
                }
                $store_images = $store->storeImages;
                foreach ($products as $key => $value) {
                    $rates = $value->rates;
                    $reviews = $value->reviews;
                    foreach ($rates as $key => $rate) {
                        $rate->delete();
                    }
                    foreach ($reviews as $key => $review) {
                        $review->delete();
                    }
                    Product::find($value->id)->delete();
                    File::delete(public_path($value->product_image));
                }
                foreach ($store_images as $key => $value) {
                    StoreImage::find($value->id)->delete();
                    File::delete(public_path($value->db_address));
                }
                $store->delete();
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => [
                        'head' => 'Sukses',
                        'body' => "Seller $user->name berhasil dihapus!"
                    ]
                ], 200);
            }
            // toast("User $user->name erhasil dihapus", "success");
        } catch (\Throwable $th) {
            if ($th->getMessage()== 'App\Models\User::stores must return a relationship instance.') {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => [
                        'head' => 'Sukses',
                        'body' => "User $user->name dihapus"
                    ]
                ], 200);
            }
            return response()->json([
                'status' => true,
                'message' => [
                    'head' => 'Sukses',
                    'body' => $th->getMessage()
                ]
            ], 500);
        }
    }
    public function delete_store($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            toast("User $user->name berhasil dihapus", "success");
        } catch (\Throwable $th) {
            toast("Oops", "error");
        }
    }
    public function delete_product($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            toast("User $product->name berhasil dihapus", "success");
        } catch (\Throwable $th) {
            toast("Oops", "error");
        }
    }
}
