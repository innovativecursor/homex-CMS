<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Contact;
use App\Models\Testimonials;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use App\Models\Achievements;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function aboutpage(){
        $about=About::where('id',2)->first();
        return response()->json(['success'=>true,'message'=>'About Page Data Get Successfully.','data'=>$about]);
    }
    public function getachivements(){
        $about=Achievements::where('id',1)->first();
        return response()->json(['success'=>true,'message'=>'Achivement Data Get Successfully.','data'=>$about]);
    }
    public function gettestimonials(){
        $data=Testimonials::all();
        return response()->json(['success'=>true,'message'=>'Testimonials Data Get Successfully.','data'=>$data]);
    }
    public function getproject(){
        $project=Project::all();
        return response()->json(['success'=>true,'message'=>'Project Data Get Successfully.','data'=>$project]);
    }
    public function getservice(){
        $serviceDetail = \App\Models\ServiceDetail::find(1);
        $service=Service::all();
        return response()->json(['success'=>true,'message'=>'Service Data Get Successfully.', 'data' => [
            'serviceDetail' => $serviceDetail,
            'services' => $service,
        ],]);
    }
    public function getteam(){
        $team=Team::all();
        return response()->json(['success'=>true,'message'=>'Team Data Get Successfully.','data'=>$team]);
    }
    public function projectdetails(Request $request){
        $projectdetails=Project::where('id',$request->id)->first();
        return response()->json(['success'=>true,'message'=>'Project Details Data Get Successfully.','data'=>$projectdetails]);
    }
    public function storecontact(Request $request, RateLimiter $rateLimiter){
       // Unique key for rate limiting per IP address or user
            $key = 'contact_form_' . $request->ip();

            // Check if the rate limit has been exceeded
            if ($rateLimiter->tooManyAttempts($key, 11)) { // Allow 11 attempts per minute
                return response()->json([
                    'message' => 'You have reached the maximum request limit. Please try again later.',
                    'error' => 'Too Many Requests',
                    'status_code' => 429
                ], 429);
            }

            // Proceed with storing the contact data
            $team = new Contact();
            $team->name = $request->name;
            $team->email = $request->email;
            $team->phone = $request->phone;
            $team->message = $request->message;
            $team->subject = $request->subject;
            $team->save();

            // Increment the attempts after a successful request
            $rateLimiter->hit($key, 60); // 60 seconds window (1 minute)

            return response()->json([
                'success' => true,
                'message' => 'Contact Form Data Has Been Stored Successfully.',
                'data' => []
            ]);
    }
}
