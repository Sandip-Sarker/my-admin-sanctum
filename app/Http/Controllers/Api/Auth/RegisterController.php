<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function response;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->save();

        if (!$user)
        {
            return response()->json([
               'status' => false,
               'message'=> 'User Register failed',
               'data'   => null
            ]);
        }

        return response()->json([
            'status' => true,
            'message'=> 'User Registration Successfully ',
            'data'   => $user
        ]);

    }
}
