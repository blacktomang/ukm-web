<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $pathImage = "upload/product/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $products = Product::all();
        $store_data = $user->stores;
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
            'product_price'=> 'required',
            'product_image'=>'required'
        ]);
        try {
            $files = $request->file('product_image');
            $fileName = $files->hashName();
            $files->move($this->pathImage, $fileName);
           
            Product::create([
                'store_id'=> $request->store_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_image' => asset($this->pathImage. $fileName),
            ]);
            return redirect()->back()->with('success', 'Upload Metode Pembayaran berhasil');
        } catch (\Throwable $th) {
          dd($th);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
