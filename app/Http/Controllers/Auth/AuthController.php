<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('Admin.login');
    }

    public function loginuser(Request $request)
    {

        $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email']);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('project-list');
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout(){
        $user = Auth::logout();
        return redirect()->route('login');
    }
}
