<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request):JsonResponse
    {
        $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name ;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //$token = $user->createToken('token')->accessToken;

        return response()->json(['data'=>'Creado Exitosamente'],200);
    
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];


            if (auth()->attempt($credentials)) 
            {
                $user = auth()->user();
             
                $token = $user->createToken($user->email)->accessToken;

                return response()->json([
                    'user' => $user,
                    'token' => $token
                ],200);
            } else {
                return response()->json(['error'=>'Unauthorised'],401);
            }
        } catch(\Exception $e) {
            Log::info($e);
            return response()->json(['error'=>'fail Login'],401);
        }
    }
    public function logout()
    {

        $token = auth()->user()->token();
        $token->revoke();

        return response()->json(['data'=>'logged out success'],200);

        
        
    }
    
    
}
