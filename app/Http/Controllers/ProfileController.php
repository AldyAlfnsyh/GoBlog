<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index(){
        return view("auth.profile",['title' => 'profile', 'user' => Auth::user()]);
    }

    public function update(Request $request){
        

        $validateData = $request->validate([
            'name' => 'required|max:255',
            'user_name' => ['required', 'min:6', 'max:255', 'unique:users,user_name,' . Auth::id()],
            'email' => 'required|email:dns|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8|max:255',
            'image' => 'nullable|image'
        ]);
        $slug = Str::of($validateData['name'])->slug('-');
        $user = User::find(Auth::id());
        if ($request->hasFile('image')) {
            if($user->image  && $user->image!='user/user.png'){
                Storage::disk('public')->delete($user->image);
            }
            $path = $request->file('image')->store('user','public');
            $user->image = $path;
        }

        if(!empty($validateData['password'])){
            $user->password = $validateData['password'];
        }
        
        
        $user->name = $validateData['name'];
        $user->user_name = $validateData['user_name'];
        $user->email = $validateData['email'];
        
        $user->slug = $slug;
        
        $user->save();

        return back()->with('success', 'Update profile success.');
    }
}
