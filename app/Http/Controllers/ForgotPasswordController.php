<?php

// app/Http/Controllers/ForgotPasswordController.php

// app/Http/Controllers/ForgotPasswordController.php

// app/Http/Controllers/ForgotPasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail; // Import the Mailable

class ForgotPasswordController extends Controller
{
    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('forgot-password'); // Make sure this matches the path of your view
    }

    // Process the forgot password request and send a new password
    public function sendNewPassword(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Get the user by email
        $user = User::where('email', $request->email)->first();

        // Generate a new random password
        $newPassword = Str::random(8);  // You can change the length as per requirement

        // Update the user's password
        $user->password = Hash::make($newPassword);
        $user->save();

        // Send an email with the new password to the user
        Mail::to($user->email)->send(new ForgotPasswordMail($newPassword));

        // Return success message
        return back()->with('status', 'A new password has been generated and sent to your email address.');
    }
}
