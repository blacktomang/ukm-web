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
use Illuminate\Support\Facades\Auth;
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
    public function users(Request $req)
    {
        if($q=$req->query('q')) 
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })->with('roles')->where('name', 'like', "%$q%")->paginate(10);
        else
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })->with('roles')->paginate(10);
        return view('pages.admin.users', compact('users'));
    }

    public function products(Request $req)
    {
        if($q=$req->query('q')) 
            $products = Product::where('product_name', 'like', "%$q%")->paginate(10);
        else
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
    public function stores(Request $req)
    {
        if($q=$req->query('q')) 
            $stores = Store::where('store_name', 'like', "%$q%")->paginate(10);
        else
            $stores = Store::paginate(10);
        return view('pages.admin.stores', compact('stores'));
    }
    public function delete_user($id){
        $user = User::find($id);
        try {
            if (!is_integer($user->stores)) {
                $store = $user->stores;
                if ($store == null) {
                    $user->delete();
                    return response()->json([
                        'status' => true,
                        'message' => [
                            'head' => 'Sukses',
                            'body' => "Seller $user->name dihapus"
                        ]
                    ], 200);
                }
                $products = $store->products;
                if ($products == null) {
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
                    'head' => 'Oops',
                    'body' => $th->getMessage()
                ]
            ], 500);
        }
    }
    public function delete_store($id)
    {
        try {
            $user = Store::find($id);
            $user->delete();
            toast("UKM $user->name berhasil dihapus", "success");
        } catch (\Throwable $th) {
            toast("Oops", "error");
        }
    }
    public function delete_product($id)
    {
        try {
            $product = Product::find($id);
            $image = $product->product_image;
            $product->delete();
            if ($image) {
                File::delete(public_path($image));
            }
            toast("User $product->name berhasil dihapus", "success");
            return back();
        } catch (\Throwable $th) {
            toast("Oops", "error");
            return back();
        }
    }

    public function maintenance(){
        
        try {
            if (!Auth::check()) {
                    return  response()->json([
                        'status' => false,
                        'message' => [
                            'head' => 'Oops',
                            'body' => "You are not an admin!"
                        ]
                    ], 500);
            }
            User::whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })->with('roles')->delete();
            Rate::truncate();
            Review::truncate();
            Store::truncate();
            Product::truncate();
            return  response()->json([
                'status' => true,
                'message' => [
                    'head' => 'Berhasil',
                    'body' => 'Data berhasil direset'
                ]
            ], 200);
        } catch (\Throwable $th) {
            return  response()->json([
                'status' => false,
                'message' => [
                    'head' => 'Oops',
                    'body' => $th->getMessage()
                ]
            ], 500);
        }
    }
}
