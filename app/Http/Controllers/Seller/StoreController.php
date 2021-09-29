<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        if($user->stores()->exists()){
            // dd($user->stores);
            $store = $user->stores;
            $store_images = $store->storeImages;
            return view('pages.seller.ukmprofile', compact('store', 'store_images'));
        }
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
        return view('pages.seller.dashboard');
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
        $store = Store::find($id);
        try {
             $store->update([
                'store_name' => $request->store_name,
                'contact' => $request->contact,
                'description' => $request->description,
                'address' => $request->address,
            ]);
            if ($request->filenames) {
                app('App\Http\Controllers\Seller\StoreImageController')->store($request->filenames, $store->id, $request->nib);
            }
            toast("Profil UKM berhasil diupdate", "success");
            return redirect()->back();
        } catch (\Throwable $th) {

            toast($th->getMessage(), "error");
            return redirect()->back();

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
        //
    }
}
