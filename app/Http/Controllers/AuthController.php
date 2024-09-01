<?php

namespace App\Http\Controllers;

use App\Helper\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Laravel\Passport\HasApiTokens;
use App\Models\User;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
      
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email', 
    //         'password' => 'required',
    //     ]); 
    
    //     $check = $this->authService->login($request['email'], $request['password']);

    //     if (!$check) {
    //         return response()->json(['message' => 'Unauthorized'], 401);
    //     }

    //     $credentials = request(['email', 'password']);

    //     if (!Auth::attempt($credentials)) {
    //         return response()->json(['message' => 'Unauthorized'], 401);
    //     }
    //     $user = Auth::user();





    //     Logger::info('user', $user);
    //     // 加上設定 token 有效期限
    //     $expiresAt = now()->addDays(1);
    //     //$token = $request->user()->createToken($request->token_name);
    //     // $token = $request->user()->createToken('authToken', ['server:read'])->plainTextToken;
    //     // $token = $user->createToken(name: 'authToken', expiresAt: $expiresAt)->plainTextToken;
    //     $token = $request->user->createToken('Token');
    //     Logger::info('token', $token);
    //     return $this->success([
    //         // 'token' => $token,
    //         'token_type' => 'Bearer',
    //         'expires_at' => $expiresAt,
    //     ]);
    // }
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if(!Auth::attempt($validateData)){
            return response('登入失敗',401);
        }


        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        Logger:info("token", $token);

        $user = $request->user();
        //$token = $user->createToken('Token');
        $token = User::find(1)->createToken('test');
        // dd($token);
        Logger::info('token', $token);
        $token->token->save();
        return response(['token'=>$token->accessToken]);
    }

    
}
