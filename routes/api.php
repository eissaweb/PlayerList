<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// index: list of the football players
Route::get('players', 'PlayersController@index');
// show one player
Route::get('player/{id}', 'PlayersController@show');
// store a new player
Route::post('player', 'PlayersController@store');
// Delete the Player
Route::delete('player/{id}', 'PlayersController@destroy');
// update current one
Route::put('player', 'PlayersController@update');