<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'password'=>['required']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json('success', 200);
    }

    public function login(Request $request) {
        $request->validate([
            'email'=>['required'],
            'password'=>['required']
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return response()->json(['success' => true, 'user' => Auth::user()],200);
        }

        return response()->json('invalid credentials', 500);
    }

    public function logout(Request $request) {
        Auth::logout();
    }
}
