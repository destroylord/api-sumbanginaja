<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Food;
use App\Models\PointHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateQRController extends Controller
{
    public function generateToPoint(Request $request)
    {
        $scan = new PointHistory();

        $scan->user_id = Auth::user()->id;
        $scan->barcode = $request->barcode;
        $scan->type = $request->type;
        $scan->qty = $request->qty;
        $scan->save();

        return response()
                ->json([
                    'status' => true,
                    'message' => 'success add point',
                ],200);
    }
}
