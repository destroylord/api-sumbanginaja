<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{

    public function searchFood(Request $request)
    {
        $name   = $request->name;
        if ($name >= 0) {
            $result = Food::whereLike('name', $name)->get();
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
    }

    public function getAll()
    {
        $foods = FoodResource::collection(Food::with('user')->get());

        return response()
                    ->json([
                        'message'  => 'show data foods',
                        'data'      => $foods
                    ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'images'    => 'required|mimes:jpg,jpeg,png',
            'descriptions' => 'required',
            'payback_time' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'error' => $validator->errors()
                        ], 401);
        }


        if ($request->images->isValid()) {
        
            // $file = $request->file->store('public/foods');

            $file_name = time(). '.' .$request->images->extension();
            $request->images->move(public_path('foods'), $file_name);
            $path = 'public/foods/'.$file_name;

            $food = new Food();
            $food->name = $request->name;
            $food->images = $path;
            $food->descriptions = $request->descriptions;
            $food->payback_time = $request->payback_time;
            $food->user_id = Auth::user()->id;
            $food->save();

            return response()
                        ->json([
                            'success' => true,
                            'message' => 'Add Data successfully!',
                            'data' => $food
                        ],201);
        }
    }

    public function show($id)
    {
        $food = Food::with('user')->findOrFail($id);
        return response()
                    ->json([
                        'message'   => 'Retrieved Successfully!',
                        'data'      => new FoodResource($food)
                    ],200);
    }

    public function update($id)
    {
        
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return response()
                    ->json([
                        'message' => 'Food deleted'
                    ],200);
    }
}
