<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function join(Request $request)
    {
        try {

            $community  = Community::findOrFail($request->community_id);
            $user_id    = Auth::user()->id;
            $community->users()->attach($user_id);
    
            return response()
                        ->json([
                            'status'    => true,
                            'message'   => 'success join cummunity',
                        ],200);
        } catch (\Exception $e) {
            return response()
                    ->json([
                        'status'    => false,
                        'message'   => $e->getMessage(),
                    ],500);
        }
    }
}
