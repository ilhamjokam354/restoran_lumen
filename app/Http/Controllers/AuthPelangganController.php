<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App;

use Log;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Requests\LoginValidation;

class AuthPelangganController extends Controller
{
    //
    

    public function __construct(JWTAuth $jwt, Auth $auth)
    {
        Auth::shouldUse('pelanggans');
        $this->jwt = $jwt;
    }
    public function loginPelanggan(Request $request){
        Config::set('auth.defaults.guard', 'pelanggans'); 
        Config::set('jwt.user', 'App\Pelanggan'); 
		Config::set('auth.providers.pelanggans.model', \App\Pelanggan::class);
       
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {

            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }
        

        $token = compact('token')['token'];
        
        $email = $request->input('email');
        $user = Pelanggan::where('email', $email)->first();
        $user->update([
            'api_token' => $token
        ]);
        
        return $this->respondWithToken($token);
    }

}
