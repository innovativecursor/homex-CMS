<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Yajra\DataTables\DataTables;



class ContactController extends Controller
{
    public function index(){
        return view('Admin.contact');
    }

    public function datable(Request $request)
    {
        $contact = Contact::select('id', 'name', 'phone','email','subject','message');

        return DataTables::of($contact)
        ->addColumn('action', function($row) {

            // $deleteBtn = '<a onclick="return confirm(\'Are you sure you want to delete this record?\')" href="' . route('testimonials-delete', $row->id) . '" class="btn btn-sm btn-danger">Delete</a>';
            $deleteBtn = \App\Models\User::getdeletebutton($row->id,'contact-delete');
            return $deleteBtn;
        })
            ->addIndexColumn()
            ->make(true);
    }

    public function delete($id)
    {
        $contact = Contact::where('id', $id)->delete();
        return redirect()->route('contact-list')->with('success', 'Contact Successfully Deleted..');
    }
}
