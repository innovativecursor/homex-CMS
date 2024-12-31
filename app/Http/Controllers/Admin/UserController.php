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
    public function __construct()
    {
        // Ensure the user is authenticated and has role 1
        if (\Auth::check() && \Auth::user()->role != 1) {
            // If role is not 1, redirect to home or show an error message
            return redirect()->route('project-list')->with('error', 'You do not have permission to access this page.');
        }
    }
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
                $editBtn = '<a href="' . route('user-edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>';
                $deleteBtn = '<a onclick="return confirm(\'Are you sure you want to delete this record?\')" href="' . route('user-delete', $row->id) . '" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>';

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

}
