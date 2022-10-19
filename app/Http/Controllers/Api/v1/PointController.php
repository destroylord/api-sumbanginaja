<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\PointHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function history()
    {
        try {
            $getHistory = PointHistory::all();
            $count = PointHistory::sum('qty');
            return response()
                ->json([
                    'status'    => true,
                    'message'   => 'success get data history',
                    'data'      => $getHistory,
                    'count'     => $count
                ], 200);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 500);
        }
    }
}
