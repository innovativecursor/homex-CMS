<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Yajra\DataTables\DataTables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class TeamController extends Controller
{
    public function index()
    {
        $team = Team::all();
        return view('Admin.Team.list', compact('team'));
    }

    public function datable(Request $request)
    {
        $team = Team::select('id', 'name', 'designation');

        return DataTables::of($team)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('team-edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                $deleteBtn = \App\Models\User::getdeletebutton($row->id,'team-delete');
                // Escape the single quotes in the confirm message or use double quotes for the outer attribute
                // $deleteBtn = '<a onclick="return confirm(\'Are you sure you want to delete this record?\')" href="' . route('team-delete', $row->id) . '" class="btn btn-sm btn-danger">Delete</a>';

                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create()
    {
        return view('Admin.Team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'team_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($request->hasFile('team_image')) {
            $image = $request->file('team_image');

            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'Team'
            ]);

            $imageUrl = $uploadedImage->getSecurePath();
        }
        $team = new Team();
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->team_image = $imageUrl;

        $team->save();
        return redirect()->route('team-list')->with('success', 'Team Successfully Add.');

    }

    public function edit($id)
    {
        $team = Team::where('id', $id)->first();
        return view('Admin.Team.edit', compact('team'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
        ]);


        $team = Team::findOrFail($id);


    if ($request->hasFile('team_image')) {
        if ($team->team_image) {
            $imageUrlParts = explode('/upload/', $team->team_image);
            $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
            $pubicids='Team/'.$publicId;

            try {
                Cloudinary::destroy($pubicids);
                \Log::info('Old image deleted from Cloudinary.');
            } catch (\Exception $e) {
                \Log::error('Error deleting old image from Cloudinary: ' . $e->getMessage());
            }
        }


        $image = $request->file('team_image');
        try {
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'Team'
            ]);


            $imageUrl = $uploadedImage->getSecurePath();


            $team->team_image = $imageUrl;
        } catch (\Exception $e) {

        }
    }

        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->save();
        return redirect()->route('team-list')->with('success', 'Team Successfully Updated.');
    }
    public function delete($id)
    {

            $team = Team::where('id', $id)->first();
            $imageUrlParts = explode('/upload/', $team->team_image);
            $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
            $pubicids='Team/'.$publicId;
            Cloudinary::destroy($pubicids);
            $team->delete();
        return redirect()->route('team-list')->with('success', 'Team Successfully Deleted..');
    }

}
