<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  =>  'required'
        ]);
        
        if ($validator->fails()) {
            return response()
                        ->json([
                            'status_code' => 400,
                            'message'     => 'Bad Request'
                        ]);
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

    }

    public function login(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'status_code' => 400,
                            'message'      => 'Bad Request'
                        ]);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()
                    ->json([
                        'status_code' => 500,
                        'message'     => 'Unauthorized'
                    ]);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()
                    ->json([
                        'status_code' => 200,
                        'token'       => $token
                    ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()
                    ->json([
                        'status_code' => 200,
                        'message'      => 'Token deteled successfully!'
                    ]);
    }
}
