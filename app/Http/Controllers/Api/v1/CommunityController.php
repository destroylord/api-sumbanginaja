<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $community = \DB::table('communities')
                        ->select('name', 'images', 'descriptions')
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

        if ($request->file('images') && $request->file('banners')->isValid()) {

            // return response('bisa kok');exit;

            $file_name = time(). '.' .$request->images->extension();
            $request->images->move(public_path('communities'), $file_name);
            $path = 'public/communities/'.$file_name;
            
            $attr = $request->all();

            $attr['images'] = request('images');
            $attr['banners'] = request('banners');

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
    public function destroy($id)
    {
        //
    }
}
