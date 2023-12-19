<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->get('search');
        $jobSeekers = User::with('location')->where('role','<>','admin')->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%')
                      ->orWhere('phone', 'like', '%' . $search . '%')
                      ->orWhere('experience', 'like', '%' . $search . '%')
                      ->orWhere('notice_period', 'like', '%' . $search . '%')
                      ->orWhere('skills', 'like', '%' . $search . '%')
                      ->orWhere('job_location', 'like', '%' . $search . '%');
            })
            ->paginate(5); 
        return view('admin.index', compact('jobSeekers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            // Find the record by ID
            $jobSeeker = User::findOrFail($id);
            // Soft delete
            $jobSeeker->delete();
    
            // If file exist remove from directory
            $photo = public_path('storage/images/'.$jobSeeker->photo_path);
            if(file_exists($photo)){
                unlink($photo);
            }
            // If file exist remove from directory
            $resume = public_path('storage/resume/'.$jobSeeker->resume_path);
            if(file_exists($resume)){
                unlink($resume);
            }
            return redirect()->route('admin.index')->with('success', 'Deleted successfully');
    }
}
