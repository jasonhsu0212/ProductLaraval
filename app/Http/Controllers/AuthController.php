<?php

namespace App\Http\Controllers;

use App\Helper\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Laravel\Passport\HasApiTokens;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
         $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }
    // public function login(Request $request)
    // {


    //     Logger::info('request', $request);
    //     $validateData = $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string'
    //     ]);
    //     if (!Auth::attempt($validateData)) {
    //         return response('登入失敗', 401);
    //     }


    //     $credentials = $request->only('email', 'password');
    //     $token = Auth::attempt($credentials);
    //     Logger::info("token", $token);

    //     $user = Auth::user();
    //     //$token = $user->createToken('Token');p
    //     // $token = User::find(1)->createToken('test');
    //     // dd($token);
    //     Logger::info('token', $token);

    //     return  response()->json([
    //         'status' => 'success',
    //         'user' => $user,
    //         'authorisation' => [
    //             'token' => $token,
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        Logger::info('token', $token);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
                //  'expires_in' => auth()->factory()->getTTL() * 60    // JWT 有效時間/分鐘
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
