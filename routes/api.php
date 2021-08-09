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

/**
 @User related
*/
Route::get('authors','App\Http\Controllers\app\UserController@index');
Route::get('authors/{id}','App\Http\Controllers\app\UserController@show');
Route::get('authors/{id}/posts','App\Http\Controllers\app\UserController@posts');
Route::get('authors/{id}/comments','App\Http\Controllers\app\UserController@comments');

// end user related

/**
 *@Post related
 */

Route::get('categories','App\Http\Controllers\app\CategoryController@index');
Route::get('categories/{id}/posts','App\Http\Controllers\app\CategoryController@posts');
Route::get('posts','App\Http\Controllers\app\PostController@index');
Route::get('posts/{id}','App\Http\Controllers\app\PostController@show');
Route::get('posts/{id}/comments','App\Http\Controllers\app\PostController@comments');



// end category related

