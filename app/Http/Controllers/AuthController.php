<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str; 
class AuthController extends Controller
{
    public function register(Request $request)
{
    // Validate the JSON request data
    $validatedData = $request->validate([
        'fullName' => 'required|string',
        'region' => 'required|string',
        'mrOrMrs' => 'required|in:Mr,Mrs',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'confirmPassword' => 'required|same:password',
        'choosenDate' => 'required|date'
    ]);

    try {
        $birthDate = Carbon::createFromFormat('Y-m-d', $validatedData['choosenDate']);
        $age = $birthDate->age;
    
        $user = new User();
        $user->name = $validatedData['fullName'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->region = $validatedData['region'];
        $user->gender = $validatedData['mrOrMrs'];
        $user->age = $age;

        $user->UniqueId = Str::uuid();

    
        $user->save();
        
        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json(['message' => 'no'], 401);
    }
    $randstr= Str::random(40) ;
    $token = $user->UniqueId . '<-ThatWasTheUserIdTryHackingMe' . $randstr;

    $user->token = $randstr;
    $user->save();
    return response()->json(['message' => $token]);
}

}
