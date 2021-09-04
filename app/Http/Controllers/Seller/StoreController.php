<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.seller.index');
        //
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
//   dd($request->filenames);
       $request->validate([
           'user_id' =>'required',
           'name' => 'required',
           'nib' => 'required',
           'contact' => 'required',
           'description' => 'required',
           'address'=>'required',
            'filenames' => 'required',
            // 'filenames.*' => 'required'
       ]);
       $store = Store::create([
           'user_id' => $request->user_id,
            'store_name' => $request->name,
            'contact' => $request->contact,
            'description' => $request->description ,
            'address' => $request->address ,
            // 'images' => $request->filenames ,
       ]);
        app('App\Http\Controllers\Seller\StoreImageController')->store($request->filenames, $store->id, $request->nib);
        return redirect('/');
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
