<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class HospitalAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:hospitals',
            'phone_number' => 'required',
            'password' => 'required|min:8',
            'hospital_name' => 'required',
            'hospital_type' => 'required',
            'address' => 'required',
        ]);

        $hospital = Hospital::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'hospital_name' => $request->hospital_name,
            'hospital_type' => $request->hospital_type,
            'address' => $request->address,
        ]);

        // Generate token for the newly registered hospital
        $token = $hospital->createToken('hospital-token')->plainTextToken;

        return response()->json([
            'message' => 'Hospital registered successfully',
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $hospital = Hospital::where('email', $request->email)->first();

        if (! $hospital || ! Hash::check($request->password, $hospital->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $hospital->createToken('hospital-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
