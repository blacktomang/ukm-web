<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Initiator;
use Illuminate\Http\Request;

class InitiatorController extends Controller
{
    private $pathImage = "upload/penggagas/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $initiators = Initiator::all();
        return view('pages.admin.index', compact('initiators'));
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
            'name' => 'required|string',
            'quote' => 'required|string',
            'photo' => 'required',
        ]);
        $files = $request->file('photo');

        $fileName = time() . $files->hashName();
        $files->move($this->pathImage, $fileName);
        try {
            Initiator::create([
                'name' => $request->name,
                'quote' => $request->quote,
                'photo' => $this->pathImage . $fileName,
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
        $initiator = Initiator::find($id);
        try {
            $image = $initiator->photo;
            File::delete($image);
            $initiator->delete();
            toast("Data $initiator->name berhasil dihapus", 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast("Terjadi kesalahan saat menghapus produk $initiator->product_name", "error");
            return
                redirect()->back();
        }
    }
}
