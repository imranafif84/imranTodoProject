<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/todo', ['uses'=>'SearchController@listTodo']);

Route::get('/user', ['uses'=>'SearchController@listUser']);
Route::get('/user/{field}/{value}', ['uses'=>'SearchController@searchUserParent']);
Route::get('/user/{parent}/{field}/{value}', ['uses'=>'SearchController@searchUserChild']);
