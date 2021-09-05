<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Store;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function home(){
       $products =  Product::all();
       for ($i=0; $i < count($products); $i++) {
            $products[$i]['product_price'] = Product::rupiah($products[$i]['product_price']);
            $products[$i]['reviews'] = count($products[$i]->reviews);
       }
        return view('welcome', compact('products'));
    }
    public function product(){
        $products =  Product::all();
        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['product_price'] = Product::rupiah($products[$i]['product_price']);
            $products[$i]['reviews'] = count($products[$i]->reviews);
        }
        return view('products', compact('products'));
    }
    public function detailProduct($id)
    {
        $product = Product::find($id);
        // dd($product->product_image);
        $reviews = count($product->reviews);
        $stores = $product->stores; 
        // dd($stores);
        $product['product_price'] = Product::rupiah($product['product_price']);
        return view('pages.product.index', compact('product', 'reviews', 'stores'));
    }
    public function about(){
        $stores = Store::all();
        return view('about', compact('stores', ));
    }
    public function profil(){
        
    }
    public function storeDetail($id){
        $store = Store::find($id);
        $products = $store->products;
        $owner = $store->owner;
        $store_images = $store->storeImages;
        $other_stores = Store::where('id',!$id);

        $review_counts = 0;
        for ($i=0; $i < count($products); $i++) {
            $reviews = Review::where('product_id', $products[$i]->id)->get();
            $review_counts += count($reviews);
        }
        return view('pages.store.index', compact('store', 'products', 'review_counts', 'owner', 'store_images', 'other_stores'));
    }
    protected function countReviews(array $products){

    }
}
