<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);

        // Modificar el Request
        $request->request->add(['username'=> Str::slug($request->username)]);
        // Validation
        $this->validate($request, [
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users|max:20',
            'password' => 'required|confirmed|min:6',
        ]);
        // Add User
        User::create([
            'name'=> $request->name,
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        // Autenticar Usuario
        auth()->attempt([
            'email'=> $request->email,
            'password'=> $request->password,
        ]);

        //Redireccionar
        return redirect()->route('posts.index');
    }
}
