<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login', ['title' => 'Login']);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(!Auth::user()->is_admin){
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('filament.admin.pages.dashboard');
            }

        }
        return back()->with('errorLogin', 'Invalid email or password');
    }

    public function logout(Request $request):RedirectResponse{
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
