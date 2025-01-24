<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function auth()
    {
        return view('admin.auth');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function doRegister(Request $request)
    {

        //dd($request->all());
        $user = User::where('email', $request->email)->first();

        if(!$user && $request->terms == 'checked')
        {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'admin',
                'is_active' => 1,
                'password' => Hash::make($request->password),
            ]);

            if(\Auth::guard()->attempt(['email'=>$request->email,'password'=>$request->password]))
            {
                return redirect()->route('login');
            }else {
                return redirect()->back()->with('error', 'something wrong ');
            }
        }else
        {
            return redirect()->back()->with('error', 'Record already exist, Please log in');

        }
    }

    public function doLogin(Request $request)
    {
        if(\Auth::guard()->attempt(['email'=>$request->email,'password'=>$request->password]))
        {

            if(\Auth::user()->role == 'admin') {
                return redirect()->route('admin-dashboard');
            } elseif(\Auth::user()->role == 'sub_admin') {
                return redirect()->route('sub-admin-dashboard');
            } elseif(\Auth::user()->role == 'delivery_boy') {
                return redirect()->route('delivery-boy-dashboard');
            }



        }else
        {
            \Session::flash('alert-danger', 'Wrong Credentials');
            return redirect()->back();
        }
    }

    public function logout()
    {
        \Auth::logout();

        return redirect('/');
    }
}
