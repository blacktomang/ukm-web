<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Initiator;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Review;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Double;

class ViewController extends Controller
{
    public function home()
    {
        $initiators = Initiator::all();
        $products =  Product::orderBy('rate', 'desc')->limit(5)->get();
        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['product_price'] = Product::rupiah($products[$i]['product_price']);
            $rates = 0;
            $rate_model_count = 0;
            $rate_data = $products[$i]->rates;
            if (count($rate_data) > 0) {
                for ($j = 0; $j < count($rate_data); $j++) {
                    $rates += $rate_data[$j]->value;
                    $rate_model_count += 1;
                }
                $products[$i]['rates'] = floor($rates / $rate_model_count);
            }
            $products[$i]['reviews'] = count($products[$i]->reviews);
        }
        return view('welcome', compact('products', 'initiators'));
    }
    public function product()
    {
        $products =  Product::orderBy('rate', 'desc')->get();
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
        return view('products', compact('products'));
    }
    public function detailProduct($id)
    {
        // dd(Auth::user()->id);
        $product = Product::find($id);
        $product->update([
            'rate' => $product->rate += 0.2,
        ]);
        $rates = $product->rates;
        $reviews = $product->reviews;
        $stores = $product->stores;
        $comments = [];
        $count_reviews = count($reviews);
        $count_rates = count($rates);
        for ($i = 0; $i < $count_reviews; $i++) {
            $temp_data = [];
            $temp_data["user_id"] = $reviews[$i]->user_id;
            $temp_data["user_name"] = User::find($reviews[$i]->user_id)->name;
            $temp_data["rate"] = $rates[$i]->value;
            $temp_data["id"] = $rates[$i]->id;
            $temp_data["comment"] = $reviews[$i]->value;
            $temp_data["rate_remains"] = 5 - $rates[$i]->value;
            $temp_data["time"] = $reviews[$i]->created_at->diffForHumans();
            if (Auth::check() && Auth::user()->id == $reviews[$i]->user_id) {
                array_unshift($comments, $temp_data);
            } else {
                array_push($comments, $temp_data);
            }
        }
        // dd($comments);
        $product['product_price'] = Product::rupiah($product['product_price']);
        return view('pages.product.index', compact('product', 'count_reviews', 'count_rates', 'stores', 'reviews', 'rates', 'comments',));
    }
    public function about()
    {
        $stores = Store::all();
        return view('about', compact('stores',));
    }
    public function profil()
    {
    }
    public function storeDetail($id)
    {
        $store = Store::find($id);
        $products = $store->products;
        $owner = $store->owner;
        $store_images = $store->storeImages;
        $other_stores = Store::where('id', !$id);

        $review_counts = 0;

        for ($i = 0; $i < count($products); $i++) {
            $reviews = Review::where('product_id', $products[$i]->id)->get();
            $review_counts += count($reviews);
        }
        return view('pages.store.index', compact('store', 'products', 'review_counts', 'owner', 'store_images', 'other_stores'));
    }
    protected function countReviews(array $products)
    {
    }
    public function createReviewsRate($id, Request $request)
    {
        try {
            // dd(floatval($request->rate_value));
            $product = Product::find($id);
            $product->update([
                'rate' => $product->rate += 0.3,
            ]);
            $product->rates()->create([
                'product_id' => $id,
                'user_id' => Auth::id(),
                'value' => floatval($request->rate_value)
            ]);
            $product->reviews()->create([
                'product_id' => $id,
                'user_id' => Auth::id(),
                'value' => $request->review_value
            ]);
            toast("Terimakasih komennya!", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back();
        }
    }
    public function editCommentReview($id, Request $request)
    {
        try {
            $review = Review::find($id);
            $rate = Rate::find($id);
            //  dd($review);/
            $product = $review->product->id;
            //  dd($review);
            //  dd($rate); 
            $rate->update([
                'product_id' => $product,
                'user_id' => Auth::id(),
                'value' => floatval($request->rate_value)
            ]);
            $review->update([
                'product_id' => $product,
                'user_id' => Auth::id(),
                'value' => $request->review_value
            ]);
            return array(
                "rate_value" => $rate->value,
                "review_value" => $review->value
            );
            // toast("Edit berhasil!", "success");
            // return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back();
        }
    }
    public function addRateAndBuy($id, Request $request)
    {
        $store_name = $request->store_name;
        $product_name = $request->product_name;
        $quantity = $request->quantity;
        $contact = $request->contact;
        $contact = substr_replace($contact, '62',0,1);
        try {
            $product = Product::find($id);
            $product->update([
                'rate' => $product->rate += 1.0,
            ]);
            return redirect("https://api.whatsapp.com/send/?phone=$contact&text=Hai+admin+UKM+$store_name,+saya+ingin+membeli+$product_name+sejumlah+$quantity");
            // return redirect('');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
