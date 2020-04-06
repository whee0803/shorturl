<?php

/*
 * UrlHum (https://urlhum.com)
 *
 * @link      https://github.com/urlhum/UrlHum
 * @copyright Copyright (c) 2019 Christian la Forgia
 * @license   https://github.com/urlhum/UrlHum/blob/master/LICENSE.md (MIT License)
 */

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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'api\AuthController@login');
    Route::post('signup', 'api\AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'api\AuthController@logout');
        Route::get('user', 'api\AuthController@user');
    });
});


Route::namespace('Api')->group(function () {
    Route::post('login', 'LoginController@login');
}); # 登录路由

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1',  'middleware' => 'auth:api'], function () {
    Route::apiResource('url', 'api\UrlController');
});
