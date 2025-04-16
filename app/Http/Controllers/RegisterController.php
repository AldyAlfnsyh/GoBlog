<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class RegisterController extends Controller
{
    public function index(){
        return view('auth.register', ['title' => 'Register']);
    }

    public function store(Request $request){
        $validateData = $request -> validate([
            'name' => 'required|max:255',
            'user_name' => ['required', 'min:6', 'max:255', 'unique:users' ],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255'
            
        ]);
    
        $slug = Str::of($validateData['name'])->slug('-');
        User::create([
            'name' => $validateData['name'],
            'user_name' => $validateData['user_name'],
            'email' => $validateData['email'],
            'password' => $validateData['password'],
            'slug' => $slug
        ]);

        return redirect('/login')->with('success_register', 'Registration successful! Please log in to continue.');

    }
}
