<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/admin/users", "UsersController@index");

Route::post('login', 'AuthController@login');
Route::post("register", "AuthController@register");

Route::get("user/{id}", "UsersController@detail");
Route::put("profile/{id}", "UsersController@update");
Route::put("profile/password/{id}", "UsersController@updatePassword");

Route::get("posts/all/{id}", "PostsController@index");
Route::get("posts/{id}", "PostsController@userPosts");
Route::post("post", "PostsController@store");
Route::get("post/{id}", "PostsController@detail");
Route::put("post/{id}", "PostsController@update");
Route::delete("post/{id}", "PostsController@destroy");

Route::post("comment", "CommentsController@store");
Route::put("comment/{id}", "CommentsController@update");
Route::delete("comment/{id}", "CommentsController@destroy");

Route::post("like", "LikesController@store");
Route::put("like/{id}", "LikesController@update");
Route::delete("like/{id}", "LikesController@destroy");

Route::post("friendship", "FriendshipsController@store");
Route::put("friendship/{id}", "FriendshipsController@update");

Route::middleware('auth:sanctum')->post('token', 'AuthController@generateToken');
