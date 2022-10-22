<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use App\Traits\ResponseTrait;

/**
 * @subgroup Food management
 *
 * APIs for managing foods
 *
 */

class FoodController extends Controller
{

    // use ResponseTrait;

    public function searchFood(Request $request)
    {
        $name   = $request->name;
        $result = FoodResource::collection(Food::with('cities')
            ->whereLike('name', $name)
            ->get());

        dd($result);

        if ($name >= 0) {
            return response()
                ->json([
                    'status'    => true,
                    'message'   => 'success searching name = ' . $name,
                    'data'      => $result
                ], 200);
        } else {
            return response()
                ->json([
                    'status' => false,
                    'message' => 'not found',
                ], 404);
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
            'payback_time' => 'required',
            'province_id'   => 'required',
            'city_id'   => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'error' => $validator->errors()
                ], 401);
        }


        if ($request->images->isValid()) {

            // $file = $request->file->store('public/foods');
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $file_name = time() . '.' . $request->images->extension();
            $request->images->move(public_path('foods'), $file_name);
            $path = 'foods/' . $file_name;

            $food = new Food();
            $food->name = $request->name;
            $food->images = $path;
            $food->descriptions = $request->descriptions;
            $food->status = 'ada';
            $food->food_generate_code = 'FD' . substr(str_shuffle($permitted_chars), 0, 6);
            $food->payback_time = $request->payback_time;
            $food->user_id = Auth::user()->id;
            $food->province_id = $request->province_id;
            $food->city_id = $request->city_id;
            $food->address = $request->address;
            $food->save();

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Add Data successfully!',
                    'data' => $food
                ], 201);
        }
    }

    public function show($id)
    {
        $food = Food::with('user')->findOrFail($id);
        return response()
            ->json([
                'message'   => 'Retrieved Successfully!',
                'data'      => new FoodResource($food)
            ], 200);
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return response()
            ->json([
                'message' => 'Food deleted'
            ], 200);
    }
}
