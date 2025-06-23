<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function dd;
use function response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email       = $request->email;
        $password    = $request->password;

        $user = User::where('email', $email)->first();

        if (!$user)
        {
            return response()->json([
               'status' => false,
               'message'=> 'Login Fail, please check email',
                'data' => null
            ]);
        }

        $checkPassword =  Hash::check($password, $user->password);

        if (!$checkPassword)
        {
            return response()->json([
                'status' => false,
                'message'=> 'Password Does not match',
                'data' => null
            ]);
        }

        $token =  $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'status' => true,
            'message'=> 'Login Successfully',
            'data' => $user,
            'token_type' => 'bearer',
            'toke' => $token,
        ]);
    }
}
