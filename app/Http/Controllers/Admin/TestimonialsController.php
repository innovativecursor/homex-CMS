<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;
use Yajra\DataTables\DataTables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class TestimonialsController extends Controller
{

    public function index()
    {
        $testimonials = Testimonials::all();
        return view('Admin.Testimonials.list', compact('testimonials'));
    }

    public function datable(Request $request)
    {
        $testimonials = Testimonials::select('id', 'testimonials_name', 'testimonials_location','testimonials_review','testimonials_description');

        return DataTables::of($testimonials)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('testimonials-edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                // $deleteBtn = '<a onclick="return confirm(\'Are you sure you want to delete this record?\')" href="' . route('testimonials-delete', $row->id) . '" class="btn btn-sm btn-danger">Delete</a>';
                $deleteBtn = \App\Models\User::getdeletebutton($row->id,'testimonials-delete');
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action']) // Allow HTML in the action column
            ->make(true);
    }
    public function create()
    {
        return view('Admin.Testimonials.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'testimonials_name' => 'required',
            'testimonials_location' => 'required',
            'testimonials_review' => 'required',
            'testimonials_description'=>'required',
            'testimonials_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('testimonials_image')) {
            $image = $request->file('testimonials_image');
            // dd($image->getRealPath());
            // Upload to Cloudinary
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'testimonials'
            ]);

            // Get the image URL
            $imageUrl = $uploadedImage->getSecurePath();
        }
        $testimonials = new Testimonials();
        $testimonials->testimonials_name = $request->testimonials_name;
        $testimonials->testimonials_location = $request->testimonials_location;
        $testimonials->testimonials_review = $request->testimonials_review;
        $testimonials->testimonials_description = $request->testimonials_description;
        $testimonials->testimonials_image = $imageUrl;
        $testimonials->save();
        return redirect()->route('testimonials-list')->with('success', 'Testimonials Successfully Add.');

    }

    public function edit($id)
    {
        $testimonials = Testimonials::where('id', $id)->first();
        return view('Admin.Testimonials.edit', compact('testimonials'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'testimonials_name' => 'required',
            'testimonials_location' => 'required',
            'testimonials_review' => 'required',
            'testimonials_description'=>'required',
        ]);

        $testimonials = Testimonials::findOrFail($id);


        if ($request->hasFile('testimonials_image')) {
            if ($testimonials->testimonials_image) {
                $imageUrlParts = explode('/upload/', $testimonials->testimonials_image);
                $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
                $pubicids='Team/'.$publicId;

                try {
                    Cloudinary::destroy($pubicids);
                    \Log::info('Old image deleted from Cloudinary.');
                } catch (\Exception $e) {
                    \Log::error('Error deleting old image from Cloudinary: ' . $e->getMessage());
                }
            }


            $image = $request->file('testimonials_image');
            try {
                $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                    'folder' => 'testimonials'
                ]);


                $imageUrl = $uploadedImage->getSecurePath();


                $testimonials->testimonials_image = $imageUrl;
            } catch (\Exception $e) {

            }
        }

            $testimonials->testimonials_name = $request->testimonials_name;
            $testimonials->testimonials_location = $request->testimonials_location;
            $testimonials->testimonials_review = $request->testimonials_review;
            $testimonials->testimonials_description = $request->testimonials_description;
            $testimonials->save();
            return redirect()->route('testimonials-list')->with('success', 'Testimonials Successfully Updated.');
        }
        public function delete($id)
        {

                $testimonials = Testimonials::where('id', $id)->first();
                $imageUrlParts = explode('/upload/', $testimonials->testimonials_image);
                $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
                $pubicids='testimonials/'.$publicId;
                Cloudinary::destroy($pubicids);
                $testimonials->delete();
            return redirect()->route('testimonials-list')->with('success', 'Testimonials Successfully Deleted..');
        }


}
