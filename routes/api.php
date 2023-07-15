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

Route::get("user/search", "UsersController@search");

Route::get("/admin/users", "UsersController@index");

Route::post('login', 'AuthController@login');
Route::post("register", "AuthController@register");

Route::get("user/{id}", "UsersController@getUser");

Route::post("profile/edit/{id}", "UsersController@update");
Route::put("profile/edit/password/{id}", "UsersController@updatePassword");

Route::get("posts", "PostsController@getPosts");
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

Route::get("friendships/{id}", "FriendshipsController@friendUsers");
Route::get("friendships/pending/{id}", "FriendshipsController@accFriend");
Route::post("friendship", "FriendshipsController@store");
Route::put("friendship/{id}", "FriendshipsController@update");
Route::delete("friendship/{id}", "FriendshipsController@destroy");

Route::get("majors", "MajorsController@index");
Route::get("statuses", "StatusesController@index");

Route::get("request/verifieds", "RequestVerifiedsController@index");
Route::get("request/verified/{id}", "RequestVerifiedsController@detail");
Route::get("request/verified/user/{id}", "RequestVerifiedsController@inspectUser");
Route::post("request/verified/add", "RequestVerifiedsController@store");
Route::put("request/verified/update/{id}", "RequestVerifiedsController@update");
Route::delete("request/verified/delete/{id}", "RequestVerifiedsController@destroy");

Route::get("tickets", "TicketsController@index");
Route::post("ticket/add", "TicketsController@store");

Route::middleware('auth:sanctum')->post('token', 'AuthController@generateToken');
