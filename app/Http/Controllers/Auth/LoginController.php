<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public $successStatus = 200;
    // to be modified
    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            "data" => $user,
            'role' => $user->roles->pluck('name'),
            "access_token" => $user->createToken($request->device_name)->plainTextToken,
            'verify_email'=> $user->email_verified_at? true : false
          ]);
        // ], $user->email_verified_at? 200 : 401);

    }
}
