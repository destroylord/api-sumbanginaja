<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->only(['rating', 'review']);

        $validator = Validator::make($attr, [
            'rating'      => 'required',
            'review'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'error' => $validator->errors()
                ], 401);
        } else {

            $ratings = Rating::create($attr);

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Created successfully!',
                    'data'    => $ratings
                ], 201);
        }
    }
}
