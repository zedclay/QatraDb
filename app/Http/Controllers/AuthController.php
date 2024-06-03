<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:donor,hospital',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'password' => 'required|min:8',
            'address' => 'required',
            'name' => 'required_if:user_type,donor',
            'blood_group' => 'required_if:user_type,donor',
            'date_of_birth' => 'required_if:user_type,donor|date',
            'gender' => 'required_if:user_type,donor',
            'hospital_name' => 'required_if:user_type,hospital',
            'hospital_type' => 'required_if:user_type,hospital',
        ]);

        $user = User::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'name' => $request->user_type === 'donor' ? $request->name : null,
            'blood_group' => $request->user_type === 'donor' ? $request->blood_group : null,
            'date_of_birth' => $request->user_type === 'donor' ? $request->date_of_birth : null,
            'gender' => $request->user_type === 'donor' ? $request->gender : null,
            'hospital_name' => $request->user_type === 'hospital' ? $request->hospital_name : null,
            'hospital_type' => $request->user_type === 'hospital' ? $request->hospital_type : null,
            'address' => $request->address,
            'user_type' => $request->user_type,
        ]);

        // Generate token for the newly registered user
        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'message' => ucfirst($request->user_type) . ' registered successfully',
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user_type' => $user->user_type,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
