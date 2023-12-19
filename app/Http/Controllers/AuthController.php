<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }  
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
    public function changePassword(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Incorrect current password']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        session()->put('jobSeeker', $user->id);
        return redirect()->route('jobseeker.index')->with('success', 'Password changed successfully');
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
