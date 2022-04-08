<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function formLogin() {
        if($user = Auth::user()) {
            if($user->level == '0'){
                return redirect()->intended('admin');
            }else if($user->level == '1'){
                return redirect()->intended('owner');
            }
        }

        return view('auth.login');
    }

    public function prosesLogin(Request $request) {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]);

        $kredensial = $request->only('email', 'password');

        if(Auth::attempt($kredensial)){
            $user = Auth::user();
            if($user->level == '0'){
                return response()->json([
                    'success' => true,
                    'qwerty' => 0,
                ], 200);
            }else if($user->level == '1'){
                return response()->json([
                    'success' => true,
                    'qwerty' => 0,
                ], 200);
            }
            return redirect()->intended('/');
        }

        return redirect('login')
        ->withInput()
        ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
        
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
