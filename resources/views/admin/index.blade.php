@extends('template.admin')

@section('content')
<div class="container ">
    <div class="row">

    <h1>List</h1>
    <div style="float:right">
        <a href="{{ route('logout') }}"><button type="button" class="btn btn-danger" >Logout</button></a> 
   </div>   
    <!-- Search form -->
    <form action="{{ route('admin.index') }}" method="GET">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search...">
        <button type="submit">Search</button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Experience</th>
                    <th>Notice_period</th>
                    <th>Skills</th>
                    <th>Job_location</th>
                    <th>Resume</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobSeekers as $jobSeeker)
                    <tr>
                        <td>JBS-00{{ $jobSeeker->id }}</td>
                        <td>{{ $jobSeeker->name }}</td>
                        <td>{{ $jobSeeker->email }}</td>
                        <td>{{ $jobSeeker->phone }}</td>
                        <td>{{ $jobSeeker->experience }}</td>
                        <td>{{ $jobSeeker->notice_period }}</td>
                        <td>{{ $jobSeeker->skills }}</td>
                        <td>{{ $jobSeeker->location->name }}</td>
                        <td><a href="{{ asset('storage/resume/' . $jobSeeker->resume_path) }}" >Download</a></td>
                        <!--href="{{ Storage::url('app/' . $jobSeeker->resume_path) }}"-->
                        <td><img src="{{ asset('storage/images/' . $jobSeeker->photo_path) }}" width="30px" height="30px"></img></td>
                        <td>
                        <form action="{{ route('admin.destroy', $jobSeeker->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning" type="submit">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination links -->
    {{ $jobSeekers->appends(['search' => $search])->links('pagination::bootstrap-4') }}    
  </div>
</div>

@endsection