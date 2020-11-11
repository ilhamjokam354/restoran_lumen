<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
// use Vendor\Laravel\LumenFramework\Config;
use App\User;
use App\Pelanggan;


class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    
    }

    public function postLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user->level == 'admin'){
        Config::set('auth.defaults.guard', 'api'); 
        Config::set('jwt.user', 'App\User'); 
		Config::set('auth.providers.users.model', \App\User::class);
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
        $user = User::where('email', $email)->first();
        $user->update([
            'api_token' => $token
        ]);
        
        return $this->respondWithToken($token, $user);

        }elseif($user->level == 'kasir') {
        Config::set('auth.defaults.guard', 'api'); 
        Config::set('jwt.user', 'App\User'); 
		Config::set('auth.providers.users.model', \App\User::class);
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
        $user = User::where('email', $email)->first();
        $user->update([
            'api_token' => $token
        ]);
        
        return $this->respondWithToken($token, $user);

        }else{
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Bukan Admin'
            ], 404);
        }
        
    }

    public function logout()
    {
        $this->jwt->parseToken()->invalidate();
        // JWTAuth::invalidate($token);

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(Request $request){
        $user = $request->input('user');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $level = $request->input('level');
        

        $register = User::create([
            'user' => $user,
            'alamat' => '',
            'telepon' => '',
            'email' => $email,
            'password' => $password,
            'api_token' => '',
            'level' => $level,
            'aktif' => 1
            
        ]);

        if($register){
            return response()->json([
                'success' => true,
                'message' => 'Register Succes',
                'data' => $register
            ], 201);

        }else{
            return response()->json([
                'success' => false,
                'message' => 'Register Failed',
                'data' => ''
            ], 400);
        }
    }

    public function save()
    {

        DB::table('users')->insert(
            [
                'name' => 'zaki',
                'email' => 'zaki@zaki.com',
                'password' => Hash::make("zaki"),
                'api_token' => ''
            ]
        );
    }

    public function registerPelanggan(Request $request){
        
        $user = $request->input('user');
        $alamat = $request->input('alamat');
        $telepon = $request->input('telepon');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));    
        

        $register = User::create([
            'user' => $user,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'password' => $password,
            'api_token' => '',
            'level' => 'pelanggan',
            'aktif' => 1
            
            
        ]);

        if($register){
            
            return response()->json([
                'success' => true,
                'message' => 'Register Succes',
                'data' => $register
            ], 200);
            
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Register Failed',
                'data' => ''
            ], 400);
        }

        
    }
    
    public function loginPelanggan(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user->level == 'pelanggan' && $user->aktif == 1){
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
            $user = User::where('email', $email)->first();
            $user->update([
                'api_token' => $token
            ]);
            
            return $this->respondWithToken($token, $user);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal'
            ], 404);
        }
    }

    

    
    
}