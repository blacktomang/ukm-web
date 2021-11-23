<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Initiator;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Review;
use App\Models\Store;
use App\Models\User;
use App\Models\WebBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Double;

class ViewController extends Controller
{
    public function home()
    {
        $initiators = Initiator::all();
        $web_banners = WebBanner::all();
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
        return view('welcome', compact('products', 'initiators', 'web_banners'));
    }
    public function product(Request $req)
    {
        if($q=$req->query('q')) 
            $products = Product::where('product_name', 'like', "%$q%")->orderBy('rate', 'desc')->get();
        else
            $products = Product::orderBy('rate', 'desc')->get();
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
            $temp_data["user_id"] = $reviews[$i]->user_id??0;
            $temp_data["user_name"] = User::find($reviews[$i]->user_id)->name??"User tidak ditemukan";
            $temp_data["rate"] = $rates[$i]->value;
            $temp_data["id"] = $id;
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
            $product = Product::find($id);
            $prevRate = $product->rates;
            if (count($prevRate)==0) {
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
                $product->update([
                    'rate' =>$product->rate + floatval($request->rate_value),
                ]);
                toast("Terimakasih atas reviewnya!", "success");
                return redirect()->back();
            }
            $prevTotal = 0;
            for ($i = 0; $i < count($prevRate); $i++) {
                $prevTotal += $prevRate[$i]->value;
            }
            $prevAverage = $prevTotal / count($prevRate);
            $valueNotFromUserRate = floatval($product->rate - $prevAverage);
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
            $updatedProduct = Product::find($id);
            $rate_product = $updatedProduct->rates;
            $total_rate = 0;
            for ($i=0; $i < count($rate_product); $i++) {
                $total_rate+=$rate_product[$i]->value;
            }
            $newAverage = $total_rate / count($rate_product);
            $newRate = $newAverage + $valueNotFromUserRate;
            $product->update([
                'rate' => $newRate,
            ]);
            toast("Terimakasih atas reviewnya!", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back();
        }
    }
    public function editCommentReview($id, Request $request)
    {
        try {
            $prevProduct = Product::find($id);
            $prevRate = $prevProduct->rates;
            $prevTotal = 0;
            for ($i=0; $i < count($prevRate); $i++) {
                $prevTotal += $prevRate[$i]->value;
            }
            $prevAverage = $prevTotal / count($prevRate);
            $valueNotFromUserRate = floatval($prevProduct->rate - $prevAverage); //separate value from user click etc
            $review = Review::where(['product_id'=> intval($id),'user_id'=> Auth::user()->id])->first();
            $rate = Rate::where(['product_id' => intval($id), 'user_id' => Auth::user()->id])->first();
            $rate->update([
                'value' => floatval($request->rate_value)
            ]);
            $review->update([
                'value' => $request->review_value
            ]);

            $product= $rate->product;
            $rates = $product->rates;
            $total_rate = 0;
            for ($i = 0; $i < count($rates); $i++) {
                $total_rate += $rates[$i]->value;
            }
            $average = $total_rate / count($rates);
            $newRate = $average +  $valueNotFromUserRate;
           $hmm = $prevProduct->update([
                'rate' =>$newRate,
            ]);
            // toast("Edit berhasil!", "success");
            return array(
                "rate_value" => $rate->value,
                "review_value" => $review->value,
                "resut" => $hmm
            );
            // return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back();
        }
    }

    private function updateRateYoo($id, $rate_before){
        $product = Product::find($id);
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
