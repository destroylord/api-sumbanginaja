<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function store(Request $request)
    {
        $userMember = Auth::user()->id;

        $joinCommunity = $userMember->communties()->attach($userMember);

        return response()
                    ->json([
                        'message' => 'success join cummunity',
                        'data'    => $joinCommunity
                    ],200);
    }
}
