<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    function index(){
        $AllAcount = User::paginate(10);;
        return view('adminlist', compact('AllAcount'));
    }

   public function store(Request $request)
{
    try {

        $request->validate([
            'name' => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'User_Role'     => 'required|string|max:50',
            'Branch'  => 'required|String',
         ]);

        $user = User::create([
            'name' => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'User_Role' => $request->User_Role,
            'Branch' => $request->Branch,
            'Enabled' => $request->has('Enabled')
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


 function update(Request $request, $id)
 {
     $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|email',
         'Branch' => 'nullable|string',
         'User_Role' => 'nullable|string',
         'Enabled' => 'nullable|boolean'
     ]);
 
     $user = User::findOrFail($id);
     $user->update([
         'name' => $request->name,
         'email' => $request->email,
         'Branch' => $request->Branch,
         'User_Role' => $request->User_Role,
         'Enabled' => $request->Enabled,
     ]);
 
     return response()->json(['success' => true, 'user' => $user]);
 }


 public function toggleEnabled(Request $request, $id)
{
    \Log::info("Incoming toggle request for User ID: {$id}", $request->all());

    try {
        $user = User::findOrFail($id);

        // Read the incoming value; allow JSON or form payloads.
        // Use boolean() to normalize truthy/falsy, or input() if you prefer the raw value.
        $enabled = $request->boolean('Enabled'); // returns true/false

        // If your DB column is integer (0/1) convert to int, otherwise save boolean.
        $user->Enabled = $enabled ? 1 : 0;

        $user->save();

        return response()->json([
            'message' => 'User status updated successfully.',
            'enabled' => $user->Enabled
        ], 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        \Log::warning("User toggle failed: Model not found for ID {$id}");
        return response()->json(['message' => 'User not found.'], 404);
    } catch (\Exception $e) {
        \Log::error("User toggle critical error for ID {$id}: " . $e->getMessage());
        return response()->json(['message' => 'A server error occurred. Check logs.'], 500);
    }

}


public function destroy($id)
{
  
    $user = User::find($id); 
    if ($user) {
        
        $user->delete();
        session()->flash('success', 'Admin deleted successfully.');
        
    } else {
        session()->flash('error', 'Admin not found.');
    }
    return redirect()->back(); 
}


public function updatePassword(Request $request, $id)
{
    // 1. Validation (Minimum 8 characters)
    $request->validate([
        'password' => 'required|string|min:8',
    ]);
    
    try {
        // 2. Find the user
        $user = User::findOrFail($id);
        
        // 3. HASH THE PASSWORD before saving
        $user->password = Hash::make($request->input('password'));
        
        // 4. Save the updated user
        $user->save();
        // 5. Return success response
        return response()->json([
            'message' => 'Password updated successfully.',
        ], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['message' => 'User not found.'], 404);
    } catch (\Exception $e) {
        \Log::error("Password Update Error for ID {$id}: " . $e->getMessage());
        return response()->json(['message' => 'Server error during password update.'], 500);
    }
}



}