<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm() {
        if(!Auth::user()) {
            return view('auth.login');
        }
        if(Auth::check() && Auth::user()->hasRole("admin")){
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }

    public function doLogin(LoginRequest $request)
    {
        $user = User::where('email', request('email'))->first();
        // dd($user->hasRole("admin"));
        if(!($user && $user->hasRole("admin"))){
            return redirect()->route('login')->with('error',__('You Not A Administration'));
        }
        if($user && $user->deleted_at){
            return redirect()->route('login')->with('error',__('You Deleted By Adminstratore'));
        }
        if($user && $user->active != 1){
            return redirect()->route('login')->with('error',__('You Are Not Active From Administrator'));
        }
        $credential = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];
        $remember_me = (!empty($request->remember_me))? true : false;
        if(Auth::guard('dashboard')->attempt($credential)) {
            Auth::guard('dashboard')->login($user, $remember_me);
            return redirect()->route('home')->with('success',__('Login has been successfully'));
        } else {
            return redirect()->route('login')->with('error',__('Email Or Password Is Wrong'));
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login')->with('success',__('LogOut has been successfully'));
    }
}
