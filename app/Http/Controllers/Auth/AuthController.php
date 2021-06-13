<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = FacadesValidator::make($request->all(), [
                'name'      => 'required|min:2|max:45',
                'email'     => 'required|email|unique:users',
                'password'  => 'required|min:8|max:45'
            ]);
            
            if ($validator->fails()) {
                $error = $validator->errors()->all()[0];

                return response()
                            ->json([
                                'status'      => false,
                                'message'     => $error,
                                'data'        => []
                            ], 422);
            }else {
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()
                        ->json([
                            'status'       => true,
                            'message'      => 'Account Created Successfully!',
                        ], 201);
            }
        } catch (\Exception $e) {
            return response()
                        ->json([
                            'status' => false,
                            'message' => $e->getMessage(),
                            'data' => []
                        ],500);
        }

    }

    public function login(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all()[0];
            return response()
                        ->json([
                            'status'    => false,
                            'message'   =>  $error
                        ],422);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()
                    ->json([
                        'status_code' => 500,
                        'message'     => 'Unauthorized'
                    ],500);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken')->plainTextToken;
                $user->token = $token;
    
                return response()
                ->json([
                    'status'        => true,
                    'message'       => 'Logged in!',
                    'data'          => $user
                ],200);  
            }else {
                return response()
                            ->json([
                                'status'    => false,
                                'message'   => 'invalid password.',
                                'data'      => []
                            ]);
            }
                       
        }else {
            return response()
                        ->json([
                            'status'    => false,
                            'message'   => 'email does not exits',
                            'data'      => []
                        ]);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()
                    ->json([
                        'status'        => true,
                        'message'       => 'Logout successfully!'
                    ],200);
    }
}
