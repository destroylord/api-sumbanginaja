<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{

    public function searchCommunity(Request $request)
    {
        try {
            $name   = $request->name;
            if ($name >= 0) {
                $result = Community::whereLike('name', $name)->get();
                return response()
                        ->json([
                            'status'    => true,
                            'message'   => 'success searching name = ' . $name,
                            'data'      => $result
                        ],200);            
            }else {
                return response()
                        ->json([
                            'status' => false,
                            'message' => 'not found',
                        ],404);
            }
        } catch (\Exception $e ) {
            return response()
            ->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ],500);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $community = \DB::table('communities')
                        ->select('id','name', 'images', 'descriptions')
                        ->orderBy('id','desc')
                        ->get();

        return response()
                    ->json([
                        'message'   => 'success show data',
                        'data'      => $community
                    ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->all();

        $validator = Validator::make($attr, [
            'name'      => 'required',
            'images'    => 'required|mimes:jpg,png|max:2048',
            'banners'   => 'required|mimes:jpg,png|max:2048',
            'locations' => 'required',
            'descriptions' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                    ->json([
                        'error' => $validator->errors(),
                        'validator error'
                    ],401);
        }

        if ($request->images && $request->banners->isValid()) {

            if ($request->images) {
                $file_name = time(). '.' .$request->images->extension();
                $request->images->move(public_path('communities/images'), $file_name);
                $pathImages = 'communities/images/'.$file_name;                
            }
            if ($request->banners) {
                $file_name = time(). '.' .$request->banners->extension();
                $request->banners->move(public_path('communities/banners'), $file_name);
                $pathBanners = 'communities/banners/'.$file_name;                
            }

            
            $attr = $request->all();

            $attr['images']     = $pathImages;
            $attr['banners']    = $pathBanners;
            $attr['user_id']    = Auth::user()->id;

            $data = Community::create($attr);


        return response()
                    ->json([
                        'success' => true,
                        'message' => 'Created successfully!',
                        'data'    => $data
                    ],201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $community = Community::with('user')->findOrFail($id);

        return response()
        ->json([
            'message'   => 'Retrieved Successfully!',
            'data'      => new CommunityResource($community)
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        $community->delete();

        return response()
                    ->json([
                        'message' => 'Community deleted'
                    ],200);
    }
}
