<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('Admin.about', compact('about'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'about_title' => 'required|string|max:255',
            'description' => 'required|string',
            'subdescription' => 'required|string',
            'our_values1' => 'required|string',
            'our_values2' => 'required|string',
            'our_values3' => 'required|string',
            'our_values4' => 'required|string',
            'about_image1' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'about_image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [
            'about_image1.max' => 'The about image 1 must not be greater than 5 MB.',
            'about_image2.max' => 'The about image 2 must not be greater than 5 MB.',

        ]);
        $about = About::first();

        $image1Url = null;
        $image2Url = null;

        // Check and upload about_image1 if it exists
        if ($request->hasFile('about_image1')) {
            // If an image exists, delete the old one from Cloudinary

            if ($about->about_image1) {
                if($about->about_image1){
                    $imageUrlParts = explode('/upload/', $about->about_image1);
                    $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
                    $pubicids='About/'.$publicId;

                Cloudinary::destroy($pubicids);
                }

            }
            $image1 = $request->file('about_image1');
            $uploadedImage1 = Cloudinary::upload($image1->getRealPath(), [
                'folder' => 'About',
            ]);
            $image1Url = $uploadedImage1->getSecurePath();
        } else {
            // Keep the old image if no new image is uploaded
            $image1Url = $about->about_image1;
        }

        // Check and upload about_image2 if it exists
        if ($request->hasFile('about_image2')) {
            // If an image exists, delete the old one from Cloudinary
            if ($request->about_image2) {
                if($about->about_image2){
                    $imageUrlParts = explode('/upload/', $about->about_image2);
                    $publicId = basename($imageUrlParts[1], '.' . pathinfo($imageUrlParts[1], PATHINFO_EXTENSION));
                    $pubicids='About/'.$publicId;

                     Cloudinary::destroy($pubicids);
                }

            }
            $image2 = $request->file('about_image2');
            $uploadedImage2 = Cloudinary::upload($image2->getRealPath(), [
                'folder' => 'About',
            ]);
            $image2Url = $uploadedImage2->getSecurePath();
        } else {
            // Keep the old image if no new image is uploaded
            $image2Url = $about->about_image2;
        }

        // Check if About record exists and update or create it

        if ($about) {
            $about->update([
                'about_title' => $request->about_title,
                'description' => $request->description,
                'subdescription' => $request->subdescription,
                'our_values1' => $request->our_values1,
                'our_values2' => $request->our_values2,
                'our_values3' => $request->our_values3,
                'our_values4' => $request->our_values4,
                'satisfied_clients' => $request->satisfied_clients,
                'compelete_projects' => $request->compelete_projects,
                'industury_expertise' => $request->industury_expertise,
                'about_image1' => $image1Url,
                'about_image2' => $image2Url,
            ]);
        } else {
            About::create([
                'about_title' => $request->about_title,
                'description' => $request->description,
                'subdescription' => $request->subdescription,
                'our_values1' => $request->our_values1,
                'our_values2' => $request->our_values2,
                'our_values3' => $request->our_values3,
                'our_values4' => $request->our_values4,
                'satisfied_clients' => $request->satisfied_clients,
                'compelete_projects' => $request->compelete_projects,
                'industury_expertise' => $request->industury_expertise,
                'about_image1' => $image1Url,
                'about_image2' => $image2Url,
            ]);
        }

        return redirect()->back()->with('success', 'About information saved successfully!');
    }
}
