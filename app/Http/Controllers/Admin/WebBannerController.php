<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebBanner;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class WebBannerController extends Controller
{
    private $pathImage = "upload/banners/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
            $banners = WebBanner::paginate(5);

            return view('pages.admin.banners.index', compact('banners'));
        
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
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
        ]);
        $files = $request->file('image');

        $fileName = time() . $files->hashName();
        
        $files->move(public_path($this->pathImage), $fileName);
        try {
            WebBanner::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'description' => $request->description,
                'image' => $this->pathImage . $fileName,
            ]);
            toast('Penambahan data berhasil!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            File::delete($this->pathImage . $fileName);
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
        $banner =  WebBanner::find($id);
        return $banner;
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
        try {
            $request->validate([
                'title' => 'required|string',
                'sub_title' => 'required|string',
                'description' => 'required|string',
                // 'photo' => 'required'
            ]);

            $banner = WebBanner::find($id);
            if ($request->file('image')) {
                File::delete($banner->photo);

                $files = $request->file('photo');

                $fileName = time() . $files->hashName();
                $files->move(public_path($this->pathImage), $fileName);

                $banner->update([
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'description' => $request->description,
                    'image' => $this->pathImage . $fileName,
                ]);
                toast("Data berhasil diupdate", "success");
                return redirect('/product');
            }
            $banner->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'description' => $request->description,
            ]);
            toast("Data berhasil diupdate", "success");
            return redirect('/product');
            //code...
        } catch (\Throwable $th) {
            toast("Terjadi kesalahan saat mengupdate data", "error");
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
        $banner = WebBanner::find($id);
        try {
            $image = public_path($banner->image);
            File::delete($image);
            $banner->delete();
            toast("Data $banner->name berhasil dihapus", 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast("Terjadi kesalahan saat menghapus produk $banner->name", "error");
            return
                redirect()->back();
        }
    }
}
