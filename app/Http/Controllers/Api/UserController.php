<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200, ['OK']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->password = Hash::make($request->password);
        $check_user = User::where('login_name', $request->login_name)->first();
        $check_email = User::where('email', $request->email)->first();

        if ($check_user)
            return response()->json(['status' => 'username'], 200, ['!OK']);
        else if ($check_email) 
            return response()->json(['status' => 'email'], 200, ['!OK']);

        $user =  User::create($request->all());
        if ($user) 
            return response()->json($user, 200, ['OK']);
    }

    public function check_login(Request $request) {
        $user = User::where('login_name', $request->login_name)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                $secretKey = config('jwt.secret');
                $payload = array(
                    'iss' => 'your_issuer',
                    'iat' => time(),
                    'exp' => time() + 3600,
                    'nbf' => time(),
                    'sub' => $user->id,
                    'jti' => 'your_jti',
                    'id' => $user->id,
                    'user_name' => $user->user_name,
                    'email' => $user->email,
                    'address' => $user->address,
                    'phone' => $user->phone,
                    'img_user' => $user->img_user,
                    'is_seller_restricted' => $user->is_seller_restricted,
                );

                $token = JWT::encode($payload, $secretKey, 'HS256');
                $user->update(['remember_token' => hash('sha256', $token)]);
                return response()->json($user, 200, ['OK'])->header('Authorization', 'Bearer ' . $token)->withCookie(Cookie::make('token', $token));
            }
            else 
                return response()->json(['status' => 'password'], 200, ['OK']);
        }else {
            return response()->json(['status' => 'username'], 200, ['OK']);
        }
    }

    public function decodeToken(Request $request)
    {
        $token = $request->Cookie('token');
        try {
            $payload = JWTAuth::setToken($token)->getPayload();
            $user = Auth::guard('api')->authenticate();
            return response()->json(['payload' => $payload, 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function handle_logout()  {
        $response = new Response(view('login'));
        $response->withCookie(Cookie::make('token', null, 0));
        // $response->withCookie(Cookie::make('role', null, 0));

        return $response;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
