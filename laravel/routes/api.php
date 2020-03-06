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

Route::get('login',"UsuarioController@login")->name('login');;
Route::post('logear',"UsuarioController@logear");
Route::post('usuario',"UsuarioController@store");


// Route::get('ticket',"UsuarioController@index");
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('ticket',"TicketController@index");
    // Route::get('ticket/{id}',"TicketController@show");
    Route::post('ticket',"TicketController@store");
    Route::put('ticket/{id}',"TicketController@update");
    Route::patch('ticket/{id}',"TicketController@update");
    Route::delete('ticket',"TicketController@destroy");
});
