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

//Api /api/(nome-dominio)
Route::get('/test', function(){

    return response()->json([
        'clients' => ['giovanni', 'mattia', 'luca'],
        'lorme' => 'ipsum',
    ]);
});


//endpoint Api
Route::namespace('Api')->group( function() {
    //post archive
    Route::get('/posts', 'PostController@index');
});