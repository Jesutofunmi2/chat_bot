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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$router->group([
    'prefix' => 'v1',
    'namespace' => 'App\Api\V1\Controllers'
  ], function () use ($router) {
    return require(realpath(__DIR__ .'/../') . '/app/Api/V1/routes.php');
});