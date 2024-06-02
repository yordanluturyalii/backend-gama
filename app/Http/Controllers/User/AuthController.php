<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\Auth\AuthRepository;
use App\Service\Auth\AuthService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct(protected AuthRepository $authRepository)
    {
    }

    public function register(Request $request)
    {
        $data = $request->only(['full_name', 'address', 'phone_number', 'email', 'password']);
        $rules = [
            'full_name' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required', 'unique:users,phone_number'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ];

        try {
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                throw new ValidationException($validation);
            }

            $user = $this->authRepository->addDataUser($data);

            return response()->json([
                'message' => 'Register Success',
                'user' => new UserResource($user)
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Invalid Field',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        $user = User::query()->where($login_type, $request->login)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken("$request->login - $login_type")->plainTextToken;
            return response()->json([
                'message' => 'Login Success',
                'user' => new UserResource($user),
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthenticed',
            ], 401);
        }
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => "Logout Success"], 200);
    }

    public function redirectAuth() {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
        ], 200);
    }

    public function handleAuthGoogle() {
        try {
            $socialite = Socialite::driver("google")->stateless()->user();
        } 
        catch(ClientException $e) {
            return response()->json([
                'message' => 'Invalid credentials provided'
            ], 422);
        }

        $user = $this->authRepository->getDataUserOrCreate($socialite);
        
        return response()->json([
            'message' => 'Login Success',
            'user' => new UserResource($user),
            'token' => $user->createToken($socialite->getEmail())->plainTextToken
        ], 200);
    }
}
