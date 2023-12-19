<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\JobSeekerRequest;
use App\Http\Requests\JobSeekerRequestEdit;
use App\Models\Location;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Hash;

class JobSeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobLocation = Location::all();
        if (session()->has('jobSeeker')) {
           $jobSeeker = User::findOrFail(session('jobSeeker'));
           return view('jobseeker.index', compact('jobSeeker','jobLocation'));
        }else{
            
            return view('jobseeker.index', compact('jobLocation'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobseeker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobSeekerRequest $request)
    {
        
        $validatedData = $request->validated();
        
        $photo_path = time() . '.' . $request->photo->extension();
        $request->photo->storeAs('public/images', $photo_path);
        //$photoPath = $request->file('photo')->store('photos');
        $resumePath = time() . '.' . $request->resume->extension();
        $request->resume->storeAs('public/resume', $resumePath);

        $jobSeeker = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ,
            'experience' => $validatedData['experience'],
            'notice_period' => $validatedData['notice_period'],
            'skills' => $validatedData['skills'],
            'job_location' => $validatedData['job_location'],
            'resume_path' => $resumePath,
            'photo_path' => $photo_path,
            'password' => Hash::make(12345678),
        ]);
        
        $jobSeeker->save();
        // Dispatch the event
        event(new UserCreated($jobSeeker));
        session()->put('jobSeeker', $jobSeeker->id);
        return redirect()->route('jobseeker.index')->with('success', 'Registration successful!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobSeeker = User::findOrFail($id);
        $jobLocation = Location::all();
        return view('jobseeker.index', compact('jobSeeker','jobLocation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Check if the email is unique for the provided ID
        $emailUnique = User::where('email', $request->email)
            ->where('id', '<>', $id) // Exclude the current user's ID
            ->doesntExist();
    
        if (!$emailUnique) {
            return redirect()->back()->withErrors(['email' => 'The email has already been taken.'])->withInput();
        }

        $jobSeeker = User::findOrFail($id);
        
        $jobSeeker->name = $request->name;
        $jobSeeker->email = $request->email;
        $jobSeeker->phone = $request->phone;
        $jobSeeker->experience = $request->experience;
        $jobSeeker->notice_period = $request->notice_period;
        $jobSeeker->skills = $request->skills;
        $jobSeeker->job_location = $request->job_location;
    
        // Handle file uploads only if new files are provided
        if ($request->hasFile('photo')) {
            $photoPath = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/images', $photoPath);
            $jobSeeker->photo_path = $photoPath;
        }
    
        if ($request->hasFile('resume')) {
            $resumePath = time() . '.' . $request->resume->extension();
            $request->resume->storeAs('public/resume', $resumePath);
            $jobSeeker->resume_path = $resumePath;
        }
    
        $jobSeeker->save();
        return redirect()->route('jobseeker.edit',$jobSeeker->id)->with('success', 'Update successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
