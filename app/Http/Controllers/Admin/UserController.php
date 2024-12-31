<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('name', 'email')->get();
        return view('Admin.User.list', compact('users'));
    }

    public function datable(Request $request)
    {
        $users = User::select('id', 'name', 'email');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('user-edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                $deleteBtn = '<a onclick="return confirm(\'Are you sure you want to delete this record?\')" href="' . route('user-delete', $row->id) . '" class="btn btn-sm btn-danger">Delete</a>';

                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action']) // Allow HTML in the action column
            ->make(true);
    }

    public function create()
    {
        return view('Admin.User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role=2;
        $user->save();
        $password=$request->password;
        try {
            $mail = Mail::to($user->email)->send(new LoginNotification($user,$password));
        } catch (Exception $e) {
            \Log::error('Error sending login notification email: ' . $e->getMessage());
        }
        return redirect()->route('user-list')->with('success', 'User Successfully Add.');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('Admin.User.edit', compact('user'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('user-list')->with('success', 'User Successfully Updated..');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->delete();
        return redirect()->route('user-list')->with('success', 'User Successfully Deleted..');
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
