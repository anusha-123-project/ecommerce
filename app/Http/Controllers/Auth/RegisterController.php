<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showSignUpForm()
    {
        return view('Auth.user');
    }
    public function showRegisterForm()
    {
        return view('Auth.registration');
    }
    public function signUp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            return redirect('/')->with('success', 'Welcome back!');
        }
    
        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|digits:10',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.confirmed' => 'The password and confirm password do not match.',
            'password.min' => 'The password must be at least 6 characters long.',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->phone,
            'status' => 'user',
        ]);
    
        return redirect()->route('signup')->with('success', 'Registration successful! Please log in.');
    }
    

}

