<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

/**
 *
 * @subgroup Authentication
 *
 * APIs for Authentication
 */

class AuthController extends Controller
{
    /**
     *
     * @bodyParams name string required name is the register. Example: John doe
     * @bodyParams email string required email is the register. Example: Johndoe@example.com
     * @bodyParams password string required name is the register
     * @bodyParams type string required name is the register
     */

    public function register(Request $request)
    {
        try {
            $validator = FacadesValidator::make($request->all(), [
                'name'      => 'required|min:2|max:45',
                'email'     => 'required|email|unique:users',
                'password'  => 'required|min:8|max:45',
                'type'      => 'required'
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->all()[0];

                return response()
                    ->json([
                        'status'      => false,
                        'message'     => $error,
                        'data'        => []
                    ], 422);
            } else {

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
                ], 500);
        }
    }

    /**
     * @urlParam string name required The name is string
     */
    public function store(Request $request)
    {
        $user = new User;

        $rules = [
            'name' => 'required|min:2|max:45',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:45',
            'type' => 'required'
        ];
        $data = User::where("email", $request->email)->count();
        if ($data > 0) {
            return response([
                "status" => false,
                'response' => 'Duplicate Email'
            ], 400)->header('Content-Type', 'application/json');
        } else {
            $validator = FacadesValidator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->type = $request->type;
                $result = $user->save();
                if ($result) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'response' => 'Gagal'
                    ], 400);
                }
            }
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
                ], 422);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()
                ->json([
                    "status" => false,
                    'status_code' => 500,
                    'message'     => 'Unauthorized'
                ], 500);
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
                    ], 200);
            } else {
                return response()
                    ->json([
                        'status'    => false,
                        'message'   => 'invalid password.',
                        'data'      => []
                    ]);
            }
        } else {
            return response()
                ->json([
                    'status'    => false,
                    'message'   => 'email does not exits',
                    'data'      => []
                ]);
        }
    }

    public function login_oauth(Request $request)
    {
        $user = new User;
        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return response([
                'message' => 'Data tidak terdaftar'
            ], 400);
        } else {
            $user = User::where('id', $user->id)->first();
            if ($user->type === "oauth") {
                return response([
                    "status" => true,
                    'user' => $user
                ], 200);
            } else {
                return response([
                    "status" => false,
                    'message' => 'Please login using email and password'
                ], 400);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()
            ->json([
                'status'        => true,
                'message'       => 'Logout successfully!'
            ], 200);
    }
}
