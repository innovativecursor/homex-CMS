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
    public function showChangePasswordForm()
    {
        return view('Admin.change-password'); // Blade view for the form
    }

    // Handle the password change logic
    public function changePassword(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // New password and confirmation
        ]);

        // Check if the current password matches the authenticated user
        if (!\Hash::check($request->current_password, \Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the user's password
        $user = \Auth::user();
        $user->password = $request->new_password;
        $user->save();

        // Redirect or show success message
        return redirect()->route('change-password.form')->with('success', 'Password successfully updated.');
    }
}
