<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function (Request $request) {
    return $request->user();

    Route::get('/test', function(){
        return response()
                    ->json([
                        'message' => "success testing"
                    ]);
    });
    Route::post('/logout',[AuthController::class,'logout']);
});
