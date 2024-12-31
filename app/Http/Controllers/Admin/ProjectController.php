<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Yajra\DataTables\DataTables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



class ProjectController extends Controller
{

    public function index()
    {
        $project = Project::all();
        return view('Admin.Projects.list', compact('project'));
    }

    public function datable(Request $request)
    {
        $project = Project::select('id', 'title','loction','features','exuctiontime','turnover');

        return DataTables::of($project)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('project-edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>';

                $deleteBtn = \App\Models\User::getdeletebutton($row->id,'project-delete');

                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action']) // Allow HTML in the action column
            ->make(true);
    }
    public function create()
    {
        return view('Admin.Projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'loction' => 'required',
            'features'=>'required',
            'exuctiontime'=>'required',
            'turnover'=>'required',
            'project_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'project_video' => 'required',

        ]);
        if ($request->hasFile('project_image')) {
            $image = $request->file('project_image');

            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'Project'
            ]);
            $imageUrl = $uploadedImage->getSecurePath();
        }
        if ($request->hasFile('project_video')) {
            $image = $request->file('project_video');

            $uploadedVideo = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'Project', // Specify the folder to store videos in Cloudinary
                'resource_type' => 'video' // Specify that the file is a video
            ]);

            $videoUrl = $uploadedVideo->getSecurePath();
        }



        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->loction = $request->loction;
        $project->features = $request->features;
        $project->exuctiontime = $request->exuctiontime;
        $project->turnover = $request->turnover;
        $project->project_image = $imageUrl;
        $project->project_video = $videoUrl;
        $project->save();
        return redirect()->route('project-list')->with('success', 'Project Successfully Add.');

    }

    public function edit($id)
    {
        $project = Project::where('id', $id)->first();
        return view('Admin.Projects.edit', compact('project'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'loction' => 'required',
            'features'=>'required',
            'exuctiontime'=>'required',
            'turnover'=>'required',
        ]);

        $project = Project::findOrFail($id);


    if ($request->hasFile('project_image')) {
        if ($project->project_image) {
            $imageUrlParts = explode('/upload/', $project->project_image);
            $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
            $pubicids='Project/'.$publicId;

            try {
                Cloudinary::destroy($pubicids);
                \Log::info('Old image deleted from Cloudinary.');
            } catch (\Exception $e) {
                \Log::error('Error deleting old image from Cloudinary: ' . $e->getMessage());
            }
        }


        $image = $request->file('project_image');
        try {
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'Project'
            ]);


            $imageUrl = $uploadedImage->getSecurePath();


            $project->project_image = $imageUrl;
        } catch (\Exception $e) {

        }
    }

    if ($request->hasFile('project_video')) {
        if ($project->project_video) {
            $videoUrlParts = explode('/upload/', $project->project_video);
            $publicIdsss = basename($videoUrlParts[1], '.' . pathinfo($videoUrlParts[1], PATHINFO_EXTENSION));
            $pubicidss='Project/'.$publicIdsss;

            try {
                Cloudinary::destroy($pubicidss, ['resource_type' => 'video']);
                \Log::info('Old video deleted from Cloudinary.');
            } catch (\Exception $e) {
                \Log::error('Error deleting old video from Cloudinary: ' . $e->getMessage());
            }
        }


        $video = $request->file('project_video');
        try {
            $uploadedImage = Cloudinary::upload($video->getRealPath(), [
                'folder' => 'Project',
                'resource_type' => 'video' // Specify that the file is a video
            ]);


            $videoUrl = $uploadedImage->getSecurePath();


            $project->project_video = $videoUrl;
        } catch (\Exception $e) {

        }
    }

    $project->title = $request->title;
    $project->description = $request->description;
    $project->loction = $request->loction;
    $project->features = $request->features;
    $project->exuctiontime = $request->exuctiontime;
    $project->turnover = $request->turnover;
    $project->save();
    return redirect()->route('project-list')->with('success', 'Project Successfully Add.');
    }
    public function delete($id)
    {

            $project = Project::where('id', $id)->first();
            $imageUrlParts = explode('/upload/', $project->project_image);
            $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
            $pubicids='Project/'.$publicId;
            Cloudinary::destroy($pubicids);
            $project->delete();
        return redirect()->route('project-list')->with('success', 'Project Successfully Deleted..');
    }


}
