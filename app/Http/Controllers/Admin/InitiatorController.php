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
        $initiators = Initiator::paginate(5);
        return view('pages.admin.pengagas.index', compact('initiators'));
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
        $files->move(public_path($this->pathImage), $fileName);
        try {
            Initiator::create([
                'name' => $request->name,
                'quote' => $request->quote,
                'photo' => $this->pathImage . $fileName,
            ]);
            toast('Penambahan data berhasil!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            File::delete(public_path($this->pathImage . $fileName));
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
        $initiator =  Initiator::find($id);
        return $initiator;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
                'name' => 'required',
                'quote' => 'required',
                // 'photo' => 'required'
            ]);

            $name = $request->name;
            $quote = $request->quote;


            $initiator = Initiator::find($id);
            if ($request->file('photo')) {
                File::delete(public_path($initiator->photo));

                $files = $request->file('photo');

                $fileName = time() . $files->hashName();
                $files->move(public_path($this->pathImage), $fileName);

                $initiator->update([
                    'name' =>  $name,
                    'quote' =>  $quote,
                    'photo' => $this->pathImage . $fileName
                ]);
                toast("Data $initiator->name berhasil diupdate", "success");
                return redirect('/product');
            }
            $initiator->update([
                'name' =>  $name,
                'quote' =>  $quote,
            ]);
            toast("Data $initiator->name berhasil diupdate", "success");
            return redirect('/product');
            //code...
        } catch (\Throwable $th) {
            toast("Terjadi kesalahan saat mengupdate data $initiator->name", "error");
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
        $initiator = Initiator::find($id);
        try {
            $image = $initiator->photo;
            File::delete(public_path($image));
            $initiator->delete();
            toast("Data $initiator->name berhasil dihapus", 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast("Terjadi kesalahan saat menghapus produk $initiator->name", "error");
            return
                redirect()->back();
        }
    }
}
