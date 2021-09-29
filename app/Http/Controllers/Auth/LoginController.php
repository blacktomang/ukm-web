<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
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
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
        return view('auth.login');
       
    }
    public function store(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required|min:3|max:255',
            'password' => 'required'
        ]);
        if (Auth::attempt($credential)) {
            $id = Auth::user()->id;
            $user = User::find($id);
            // dd($user->roles[0]->name);
           $request->session()->regenerate();
            // return $user->hasRole("seller")|| $user->hasRole("admin")?redirect()->intended("dashboard"):redirect()->intended('/');
            // if ($user->hasRole("admin")) {
            //    return redirect()->intended('/admin');
            // } else if($user->hasRole("admin"){

            //     return redirect()->intended('/admin');
            // } else{

            // }
            if ($user->hasRole("admin")) {
                return redirect()->intended('/admin');
            } else if ($user->hasRole("seller")){
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('/');
            }
            
        }
        return back()->with('loginError', 'Login gagal!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function show($id)
    {
        return User::find($id)->first();
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
     
    }
}
