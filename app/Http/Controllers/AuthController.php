<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 31/05/22
 * Time: 23:46
 */

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     */
    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * login user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = ["email" => $request->email, "password" => $request->password];





        // $token = $this->guard()->login($credentials);
        if (!$token = $this->guard()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized', "status" => false, "message" => "Check your email or password, user not found!"], 401,[], JSON_NUMERIC_CHECK);
        }

//        if (!$token = auth()->attempt($validator->validated())) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }

        return $this->respondWithToken($token);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function respondWithToken($token)
    {
        $user = Auth::user();

        if(!$user)  $user = JWTAuth::setToken($token)->toUser();


        $user->setAttribute('token', $token);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
//            'expires_in'   => Auth::factory()->getTTL() * 600,
            'user' => $user,
//            'expires_in' =>  auth()->factory()->getTTL() * 60
        ]);
    }
    public function guard()
    {
        return Auth::guard('api');
    }

    public function assignBranch(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'branch_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $user = User::find($request->user_id);

        if(!$user)
            return response()->json(['status'=>false, 'message'=>'User not found']);

        $user->update([
           'branch_id' =>$request->branch_id
        ]);

        return response()->json(['status' => true, 'message' => 'User assigned','user' => $user]);
    }
}