<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievements;

class AchievementsController extends Controller
{
    public function index()
    {
        // Retrieve the first achievement record
        $achievements = Achievements::first();

        // Pass the existing data to the view to populate the form
        return view('Admin.Achievements', compact('achievements'));
    }

    public function store(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'description' => 'required|string',
            'label1' => 'required|string',
            'counter1' => 'required|string',
            'label2' => 'required|string',
            'counter2' => 'required|string',
            'label3' => 'required|string',
            'counter3' => 'required|string',
        ]);

        // Retrieve the first achievement record, or null if none exist
        $achievements = Achievements::first();

        // Check if an existing record is found
        if ($achievements) {
            // Update the existing record with the new data
            $achievements->update([
                'description' => $request->description,
                'label1' => $request->label1,
                'counter1' => $request->counter1,
                'label2' => $request->label2,
                'counter2' => $request->counter2,
                'label3' => $request->label3,
                'counter3' => $request->counter3,
            ]);
        } else {
            // If no existing record, create a new one
            Achievements::create([
                'description' => $request->description,
                'label1' => $request->label1,
                'counter1' => $request->counter1,
                'label2' => $request->label2,
                'counter2' => $request->counter2,
                'label3' => $request->label3,
                'counter3' => $request->counter3,
            ]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Achievements information saved successfully!');
    }
}
