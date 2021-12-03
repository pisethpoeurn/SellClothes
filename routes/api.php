<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('clothes', 'ClothesController');
// Route::get('/clothes', function(){
//     return 'products';
// });
Route::get('/clothes', 'ClothesController@index');
Route::post('add', 'ClothesController@store');
Route::get('edit/{id}', 'ClothesController@edit');
Route::post('update/{id}', 'ClothesController@update');
Route::delete('delete/{id}', 'ClothesController@destroy');
Route::group(['prefix' => 'clothes'], function () {
});