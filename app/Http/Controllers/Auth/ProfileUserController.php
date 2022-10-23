<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PointHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 *
 * @subgroup Authentication
 *
 * APIs for Authentication
 */


class ProfileUserController extends Controller
{
    public function getProfile(Request $request)
    {
        try {
            $user_id = $request->user()->id;
            $user = User::find($user_id);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'User profile',
                    'data' => $user,
                ], 200);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'status'    => false,
                    'message'   => $e->getMessage(),
                    'data'      => []
                ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'no_handphone'  => 'required|max:12'
                // 'address'       => 'required',
                // 'profile_users' => 'required'
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()
                    ->json([
                        'status' => false,
                        'message' => $error,
                    ], 422);
            } else {
                $user = User::find($request->user()->id);

                $user->name = $request->name;
                $user->no_handphone = $request->no_handphone;
                $user->address = $request->address;

                if ($request->profile_users && $request->profile_users->isValid()) {
                    $file_name = time() . '.' . $request->profile_users->extension();
                    $request->profile_users->move(public_path('profile/profile_users'), $file_name);
                    $pathprofile_users = 'public/profile/profile_users/' . $file_name;

                    $user->profile_users = $pathprofile_users;
                }
                $user->update();

                return response()
                    ->json([
                        'status' => true,
                        'message' => 'Profile Updated',
                        'data' => $user
                    ], 200);
            }
        } catch (\Exception $e) {
            return response()
                ->json([
                    'status'    => false,
                    'message'   => $e->getMessage(),
                    'data'      => []
                ], 500);
        }
    }
}
