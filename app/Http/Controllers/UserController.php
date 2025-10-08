<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{

   public function store(Request $request)
{
    try {

        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'User_Role'     => 'required|string|max:50',
        ]);

        $user = User::create([
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'User_Role' => $request->User_Role,
        ]);

        // Optionally generate token if you want direct login
        $token = $user->createToken('auth_token')->plainTextToken ?? null;

        return redirect()->back()->with('success', 'User created successfully!');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred: '.$e->getMessage());
    }
}

   public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()
                ->withErrors(['email' => 'Invalid email or password'])
                ->withInput();
        }
    
        $request->session()->regenerate();
        
        return redirect('/home');  
    }
}
