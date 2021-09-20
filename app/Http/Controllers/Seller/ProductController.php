<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    private $pathImage = "upload/product/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $user = User::find($id);
            dd($user);
            if ($user->hasRole("buyer")) {
                return redirect('/');
            }
            // The user is logged in...
        }
        return redirect('/');

    }
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $store_data = $user->stores;
        $products = Product::paginate(10);
        for ($i = 0; $i < count($products); $i++) {
            // $products[$i]['product_price'] = Product::rupiah($products[$i]['product_price']);
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
       return view('pages.seller.product', compact('products', 'store_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'store_id'=> 'required',
            'product_name'=> 'required',
            'description'=> 'required',
            'stocks'=>'required',
            'product_price'=> 'required',
            'product_image'=>'required'
        ]);
        $files = $request->file('product_image');

        $fileName = time() . $files->hashName();
        $files->move($this->pathImage, $fileName);
        try {
           Product::create([
                'store_id'=> $request->store_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'description' => $request->description,
                'stocks' => $request->stocks,
                'product_image' => $this->pathImage. $fileName,
                'rate' => 0.0
            ]);
            toast('Penambahan data berhasil!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            File::delete($this->pathImage. $fileName);
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $product = Product::find($id);
       return view('pages.seller.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'store_id' => 'required',
                'product_name' => 'required',
                'product_price' => 'required',
                // 'product_image' => 'required'
            ]);

            $name = $request->product_name;
            $price = $request->product_price;
            

            $product = Product::find($id);
            if ($request->file('product_image')) {
                File::delete($product->product_image);

                $files = $request->file('product_image');
 
                $fileName = time() . $files->hashName();
                $files->move(public_path($this->pathImage), $fileName);

                $product->update([
                    'product_name' =>  $name,
                    'product_price' =>  $price,
                    'product_image' => $this->pathImage . $fileName
                ]);
                toast("Data $product->product_name berhasil diupdate", "success");
                return redirect('/product');
            }
            $product->update([
                'product_name' =>  $name,
                'product_price' =>  $price,
            ]);
            toast("Data $product->product_name berhasil diupdate","success");
            return redirect('/product');
            //code...
        } catch (\Throwable $th) {
            toast("Terjadi kesalahan saat mengupdate data $product->product_name", "error");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $product = Product::find($id);
        try {
            $image = $product->product_image;
            File::delete($image);
            $product->delete();
            toast("Produk $product->product_name berhasil dihapus", 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
         toast("Terjadi kesalahan saat menghapus produk $product->product_name","error");
           return
            redirect()->back();
        }
    }
}
