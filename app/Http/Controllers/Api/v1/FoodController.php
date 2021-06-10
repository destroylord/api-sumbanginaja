<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function getAll()
    {
        $foods = Food::all();

        return response()
                    ->json([
                        'message'  => 'show data foods',
                        'data'      => $foods
                    ], 200);
    }
}
