<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {

        //check dữ liệu đầu vào
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);
        $user = User::where('email', $request->email)->first();
        //guard web
        // if (!Auth::attempt($data)) {
        //     return response()->json([
        //         'message' => 'Login fail',
        //     ], 401);
        // }
        // $user = Auth::user();
        if (!$user) {
            return response()->json([
                'mess' => 'user not found',
            ], 401);
        }
        $token = $user->createToken('token-api')->plainTextToken;
        return response()->json(
            [
                'message' => 'success',
                'user' => $user,
                'token' => $token,
            ],
            200
        );
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response('Logout success', 204);
    }
}
