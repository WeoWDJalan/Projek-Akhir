<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function getProfile(){
        $profile = Auth::user()->profile;
        if($profile){
            $profile = Profile::where('user_id', Auth::id())->first();
            return view('profile.update', ['profile' => $profile]);
        } else{
            return view('profile.add');
        }
    }

    public function store(Request $request){
        // validation
        $request->validate([
            'age' => 'required',
            'bio' => 'required',
        ]);

        //DB
        $profile = new Profile();
        $profile->age = $request->input('age');
        $profile->bio = $request->input('bio');
        $profile->user_id = Auth::id();
        $profile->save();

        return redirect('/profile')->with('success', 'Profile created successfully!');
    }

    public function update(Request $request){
        // validation
        $request->validate([
            'age' => 'required',
            'bio' => 'required',
        ]);
        
        //DB
        $profile = Profile::where('user_id', Auth::id())->first();
        $profile->age = $request->input('age');
        $profile->bio = $request->input('bio');
        $profile->save();

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }
}
