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

Route::middleware('auth:sanctum')->get('/media', function (Request $request) {
    return \Modules\Media\Transformers\MediaResource::collection(\App\Media::all());
});

Route::post('media/upload', 'MediaController@store')->name('media.store');
Route::delete('media/{media}', 'MediaController@destroy')->name('media.destroy');

