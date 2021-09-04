<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\StoreImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StoreImageController extends Controller
{
    private $pathImage = "upload/stores/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(array $files, $storeId, $nib)
    {
        try {
            for ($i = 0; $i < count($files); $i++) {
                if (isset($files[$i])) {
                    $hashedName = $files[$i]->hashName();
                    $imageName = time() . $hashedName;
                    $files[$i]->move(public_path($this->pathImage . $nib), $imageName);
                    StoreImage::create([
                        'store_id' => $storeId,
                        'db_address' =>  $this->pathImage . $nib . "/" . $imageName,
                    ]);
                }
            }
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }

        //
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
        $storeImage = StoreImage::find($id);
        try {
            $image = $storeImage->db_address;
            File::delete($image);
            $storeImage->delete();
            toast("Foto berhasil dihapus", 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast("Terjadi kesalahan saat menghapus foto", "error");
            return
                redirect()->back();
        }
    }
}
