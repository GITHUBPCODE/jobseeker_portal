            @extends('template.jobseeker')

            @section('content')
                            
                <!-- Login form -->
                <div class="container">
                    <div id="login-column" class="col-md-6">
                    <h1>Login</h1>    
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Enter email">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror<br>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    </div>   </div>
            @endsection                