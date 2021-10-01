<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function chooseRole()
    {
        return view('auth.getrole');
    }
    public  function getrole(Request $request)
    {
        $role = $request->get('role');
        return redirect()->route('register.index', ['role' => $role]);
    }
    public function index(Request $request)
    {
        $role = $request->get('role');
        // dd($role);
        if ($role=='buyer' || $role =='seller' && $role !=null) {
            return view('auth.register', compact('role'));
        }
        return $this->chooseRole();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $inputRole = $request->get('role');
        $emailOrnib = $inputRole == 'buyer' ? "email" : 'nib';
        $nibOrEmailRule = $inputRole == 'buyer'? 'required|email|unique:users': 'required|unique:users';
        $validated = $request->validate([
            'name'=> 'required|max:255|min:3',
            'username'=> 'required|min:3|max:255|unique:users',
            'email' =>   $nibOrEmailRule,
            'phoneNumber'=> 'required|min:8',
            'password' => 'required|min:6',
            'address'=> 'required|min:5'
        ]);
  
        $validated['password'] = Hash::make($validated['password']);
        if ($inputRole) {
            $spatieRole = Role::where('name','=', $inputRole)->first();
            $user = User::create($validated);
            $user->assignRole($spatieRole);
            $request->session()->flash('success', 'Registrasi berhasil, silahkan login');
            if ($inputRole == 'buyer') {
                return redirect('/login');
            }else{
                $credential = $request->validate([
                    'username' => 'required|min:3|max:255',
                    'password' => 'required'
                ]);
                $user = Auth::attempt($credential);
                $request->session()->regenerate();
                return view('pages.seller.index', compact('user'));
            }

        }else {
            return back();
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
        return view('auth.getrole');
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
