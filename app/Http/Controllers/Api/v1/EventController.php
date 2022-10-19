<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;

/**
 *
 * @subgroup Event
 *
 * APIs for Event
 */


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $events = Event::all();

        return response()
            ->json([
                'message'  => 'show data event',
                'data'      => $events
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
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'images'    => 'required|mimes:jpg,png|max:2048',
            'locations' => 'required',
            'descriptions' => 'required'
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
            $request->images->move(public_path('events'), $file_name);
            $path = 'events/' . $file_name;


            $attr = $request->all();

            $attr['images'] = $path;
            $attr['status'] = $request->status('ada');
            $attr['event_generate_code'] = 'EV' . substr(str_shuffle($permitted_chars), 0, 6);

            $event = Event::create($attr);


            return response()
                ->json([
                    'success' => true,
                    'message' => 'Add Data successfully!',
                    'data' => $event
                ], 201);
        }
    }
}
