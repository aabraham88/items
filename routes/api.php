<?php


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

Route::prefix('/v1')->group(function (){
        Route::resource('items', 'ItemController');
        Route::post('/items/sort', 'ItemController@sort');
        Route::get('/items/{id}/image', 'ImageController@itemImage')->name('item.image');
    }
);
