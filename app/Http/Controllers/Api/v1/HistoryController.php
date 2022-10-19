<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food;

class HistoryController extends Controller
{
    public function index()
    {
        $foods = Food::with('ratings')->get();

        return response()
            ->json([
                'status'    => true,
                'message'   => 'Success show data Foods and ratings',
                'data'      => $foods
            ], 200);
    }
}
