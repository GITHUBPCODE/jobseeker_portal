@extends('template.jobseeker')

@section('content')
<div class="container ">
    <div class="row">
                <h1>Job Registration</h1>
                <form method="POST" action="{{ isset($jobSeeker) ? route('jobseeker.update', $jobSeeker->id) : route('jobseeker.store') }}" enctype="multipart/form-data">
                    @csrf

                    @if(isset($jobSeeker))
                        @method('PATCH') 
                        <a href="{{ route('logout') }}"><button type="button" class="btn btn-danger" >
                        Logout
                        </button></a>
                    @else    
                        <a href="{{ route('login') }}"><button type="button" class="btn btn-primary" >
                        Login
                        </button></a>                                        
                    @endif


                    
                    <br></br>
                    <input type="text" name="name" value="{{ isset($jobSeeker) ? $jobSeeker->name : old('name') }}" placeholder="Name">
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror<br>

                    <input type="email" name="email" value="{{ isset($jobSeeker) ? $jobSeeker->email : old('email') }}" placeholder="Email">
                    @error('email')<span class="text-danger">{{ $message }}</span> @enderror<br>

                    <input type="text" name="phone" value="{{ isset($jobSeeker) ? $jobSeeker->phone : old('phone') }}" placeholder="Phone">
                    @error('phone')<span class="text-danger">{{ $message }}</span> @enderror<br>

                    <input type="number" name="experience" value="{{ isset($jobSeeker) ? $jobSeeker->experience : old('experience') }}" placeholder="Experience (in Years)">
                    @error('experience')<span class="text-danger">{{ $message }}</span> @enderror<br>

                    <input type="number" name="notice_period" value="{{ isset($jobSeeker) ? $jobSeeker->notice_period : old('notice_period') }}" placeholder="Notice Period (in Days)">
                    @error('notice_period')<span class="text-danger">{{ $message }}</span> @enderror<br>

                    <input type="text" name="skills" value="{{ isset($jobSeeker) ? $jobSeeker->skills : old('skills') }}"  placeholder="Skills">
                    @error('skills')<span class="text-danger">{{ $message }}</span> @enderror<br>

                    <x-select-dropdown name="job_location" :options="$jobLocation"  :selected="isset($jobSeeker) ? $jobSeeker->job_location : old('job_location') "/>
                    @error('job_location')<span class="text-danger">{{ $message }}</span> @enderror<br>

                    @if(isset($jobSeeker))
                    <a href="{{ asset('storage/resume/' . $jobSeeker->resume_path) }}" target="_blank">View Resume</a><br><br>
                    <img src="{{ asset('storage/images/' . $jobSeeker->photo_path) }}" width="50px" height="50px" alt="Your Image"><br><br>
                    @else
                    Resume <input type="file" name="resume" value="{{ old('resume') }}">
                    @error('resume')<span class="text-danger">{{ $message }}</span> @enderror<br>
                    Photo <input type="file" name="photo" value="{{ old('photo') }}">
                    @error('photo')<span class="text-danger">{{ $message }}</span> @enderror<br>
                    @endif

                    <button type="submit">{{ isset($jobSeeker) ? 'Update' : 'Submit' }}</button>
                </form>

                <!--------------------- Change pass    -------------------------------->
                <br></br>
                @if(isset($jobSeeker))
                <form method="POST" action="{{ route('changePassword',['id' => $jobSeeker->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Current password</label>
                        <input type="password" class="form-control" value="{{ old('current_password') }}" id="current_password" name="current_password" placeholder="Enter Current Password">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror<br>
                    </div>
                    <div class="form-group">
                        <label for="password">New password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                @endif
                <!--------------------- Change pass    -------------------------------->
    </div>
</div>
@endsection