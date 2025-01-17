<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Yajra\DataTables\DataTables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();
        $serviceDetail = \App\Models\ServiceDetail::find(1);
        return view('Admin.Services.list', compact('service','serviceDetail'));
    }
    public function updatedetails(Request $request)
    {
        $serviceDetail = \App\Models\ServiceDetail::where('id',1)->first();

        // Validate the incoming request
        $request->validate([
            'main_description' => 'required|string',
        ]);

        // Update the main_description
        $serviceDetail->main_description = $request->input('main_description');
        $serviceDetail->save();

        return redirect()->route('service-list')->with('success', 'Description updated successfully');
    }

    public function datable(Request $request)
    {
        $service = Service::select('description', 'id');

        return DataTables::of($service)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('service-edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>';
                // $deleteBtn = '<a onclick="return confirm(\'Are you sure you want to delete this record?\')" href="' . route('service-delete', $row->id) . '" class="btn btn-sm btn-danger">Delete</a>';
                $deleteBtn = \App\Models\User::getdeletebutton($row->id,'service-delete');
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action']) // Allow HTML in the action column
            ->make(true);
    }
    public function create()
    {
        return view('Admin.Services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'service_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [
            'service_image.max' => 'The service image must not be greater than 5 MB.',

        ]);
        if ($request->hasFile('service_image')) {
            $image = $request->file('service_image');

            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'Service'
            ]);
            $imageUrl = $uploadedImage->getSecurePath();
        }

        $service = new Service();
        $service->description = $request->description;
        $service->service_image = $imageUrl;
        $service->save();
        return redirect()->route('service-list')->with('success', 'service Successfully Add.');

    }

    public function edit($id)
    {
        $service = Service::where('id', $id)->first();
        return view('Admin.Services.edit', compact('service'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'description' => 'required',
            'service_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [
            'service_image.max' => 'The service image must not be greater than 5 MB.',
        ]);

        $service = Service::findOrFail($id);


        if ($request->hasFile('service_image')) {
            if ($service->service_image) {
                $imageUrlParts = explode('/upload/', $service->service_image);
                $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
                $pubicids='service/'.$publicId;

                try {
                    Cloudinary::destroy($pubicids);
                    \Log::info('Old image deleted from Cloudinary.');
                } catch (\Exception $e) {
                    \Log::error('Error deleting old image from Cloudinary: ' . $e->getMessage());
                }
            }


            $image = $request->file('service_image');
            try {
                $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                    'folder' => 'Service'
                ]);


                $imageUrl = $uploadedImage->getSecurePath();


                $service->service_image = $imageUrl;
            } catch (\Exception $e) {

            }
        }

        $service->description = $request->description;
        $service->save();
        return redirect()->route('service-list')->with('success', 'service Successfully Add.');
        }
        public function delete($id)
        {

                $service = Service::where('id', $id)->first();
                $imageUrlParts = explode('/upload/', $service->service_image);
                $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
                $pubicids='Service/'.$publicId;
                Cloudinary::destroy($pubicids);
                $service->delete();
            return redirect()->route('service-list')->with('success', 'Service Successfully Deleted..');
        }


}
