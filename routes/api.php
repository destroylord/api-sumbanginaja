<?php

use App\Http\Controllers\Api\v1\CommunityController;
use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\Api\v1\FoodController as V1FoodController;
use App\Http\Controllers\Api\v1\GenerateQRController;
use App\Http\Controllers\Api\v1\HistoryController;
use App\Http\Controllers\Api\v1\MembershipController;
use App\Http\Controllers\Api\v1\PointController;
use App\Http\Controllers\Api\v1\ProvinceController;
use App\Http\Controllers\Api\v1\RatingController;
use App\Http\Controllers\Auth\{AuthController, ProfileUserController};
use Illuminate\Support\Facades\Route;

Route::post('v1/login-oauth', [AuthController::class, 'login_oauth']);
Route::post('v1/daftar', [AuthController::class, 'store']);


// Login
Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);


Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1', 'middleware' => 'auth:sanctum'], function () {

    /**
     * Searing foods and community
     */
    Route::get('/foods/{name}', [V1FoodController::class, 'searchFood']);
    Route::get('/community/{name}', [CommunityController::class, 'searchCommunity']);

    /**
     * Join to group
     */
    Route::post('/userJoinCommunity', [MembershipController::class, 'join']);
    Route::get('/ShowCommunityByUser', [MembershipController::class, 'showCommunitiesUser']);
    Route::get('/showCommunityFilter/{community_id}', [MembershipController::class, 'filterCommunities']);

    /**
     * Foods
     */
    Route::get('/foods', [V1FoodController::class, 'getAll']);
    Route::get('/food/{food:user_id}', [V1FoodController::class, 'getFoodByUser']);
    Route::get('/foods/{food:id}/show', [V1FoodController::class, 'show']);
    Route::post('/food/create', [V1FoodController::class, 'store']);
    Route::delete('/foods/{food:id}', [V1FoodController::class, 'destroy']);

    /**
     * Community
     */
    Route::get('/communities', [CommunityController::class, 'getAll']);
    Route::get('/community/{community:id}/show', [CommunityController::class, 'show']);
    Route::post('/community/create', [CommunityController::class, 'store']);
    Route::delete('/community/{community:id}', [CommunityController::class, 'destroy']);

    /**
     * Event
     */
    Route::get('/events', [EventController::class, 'getAll']);
    Route::post('/event/create', [EventController::class, 'store']);


    /**
     * Generate Code
     */
    Route::post('/scan', [GenerateQRController::class, 'generateToPoint']);


    /**
     * History
     */
    Route::get('history-point', [PointController::class, 'history']);
    Route::get('/history-food', [HistoryController::class, 'index']);


    /**
     * Profile
     */
    Route::get('/get-profile', [ProfileUserController::class, 'getProfile']);
    Route::post('/update-profile', [ProfileUserController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    /**
     * Rating
     */
    Route::post('/rating', [RatingController::class, 'store']);

    /**
     * Province
     */
    Route::get('/provinces', [ProvinceController::class, 'getAll']);
    Route::get('/province/{province_id}', [ProvinceController::class, 'getProvinceId']);
});
