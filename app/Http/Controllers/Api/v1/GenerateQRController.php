<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Food;
use App\Models\PointHostory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateQRController extends Controller
{
    public function generateToPoint(Request $request)
    {

        $food = Food::select('food_generate_code')
                    ->whereNotNull('food_generate_code')
                    ->pluck('event_generate_code')
                    ->first();
        // $arr = json_decode($food, true);

        $qr_food = substr($food, 0,2);
    
        

        $event = Event::select('event_generate_code')
                        ->whereNotNull('event_generate_code')
                        ->pluck('event_generate_code')
                        ->first();
        // $arrev = json_decode($event, true);

        $qr_event = substr($event, 0,2);

        // return response()
        // ->json([
        //     'message' => 'success add point'. $qr_event,
        // ],200);


        $scan = new PointHostory();

        $scan->user_id = Auth::user()->id;
        if ($scan->type == $qr_food) {
            $scan->type = 1;
            $scan->qty  = 5;            
            $scan->save();
        }

        else if ($scan->type == $qr_event) {
            $scan->type = 2;
            $scan->qty  = 2;            
            $scan->save();
        }

        return response()
                ->json([
                    'status' => true,
                    'message' => 'success add point',
                ],200);
    }
}
