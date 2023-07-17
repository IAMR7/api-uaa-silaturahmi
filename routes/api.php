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

Route::middleware('auth:sanctum')->group(
    function()
    {
        // TIPE => USER

        // (GROUP USER)
        Route::get("user/{id}", "UsersController@getUser");
        Route::get("users/search", "UsersController@search");
        Route::post("profile/edit/{id}", "UsersController@update");
        Route::put("profile/edit/password/{id}", "UsersController@updatePassword");

        // (GROUP POSTS)
        Route::get("posts/all/{id}", "PostsController@index");
        Route::get("posts/{id}", "PostsController@userPosts");
        Route::post("post", "PostsController@store");
        Route::get("post/{id}", "PostsController@detail");
        Route::put("post/{id}", "PostsController@update");
        Route::delete("post/{id}", "PostsController@destroy");

        // (GROUP COMMENTS)
        Route::post("comment", "CommentsController@store");
        Route::put("comment/{id}", "CommentsController@update");
        Route::delete("comment/{id}", "CommentsController@destroy");

        // (GROUP LIKES)
        Route::post("like", "LikesController@store");
        Route::put("like/{id}", "LikesController@update");
        Route::delete("like/{id}", "LikesController@destroy");

        // (GROUP FRIENDSHIPS)
        Route::get("friendships/{id}", "FriendshipsController@friendUsers");
        Route::get("friendships/pending/{id}", "FriendshipsController@accFriend");
        Route::post("friendship", "FriendshipsController@store");
        Route::put("friendship/{id}", "FriendshipsController@update");
        Route::delete("friendship/{id}", "FriendshipsController@destroy");

        // (GROUP VERIFIEDS)
        Route::get("request/verified/user/{id}", "RequestVerifiedsController@inspectUser");
        Route::post("request/verified/add", "RequestVerifiedsController@store");
        Route::put("request/verified/response/{id}", "UsersController@handleVerified");

        // (GROUP TICKETS)
        Route::post("ticket/add", "TicketsController@store");

        // ------------------------------------------------------------------------------------

        // TIPE => ADMIN
        
        // (GROUP USERS)
        Route::get("/admin/users", "UsersController@index");
        Route::delete("/admin/user/delete/{id}", "UsersController@destroy");
        Route::post("/admin/user/add", "UsersController@addAdmin");

        // (GROUP POSTS)
        Route::get("posts", "PostsController@getPosts");
        Route::delete("admin/post/delete/{id}", "PostsController@destroy");

        // (GROUP MAJORS)
        Route::get("major/detail/{id}", "MajorsController@detail");
        Route::post("major/add", "MajorsController@store");
        Route::put("major/update/{id}", "MajorsController@update");
        Route::delete("major/delete/{id}", "MajorsController@destroy");

        // (GROUP STATUSES)
        Route::get("status/detail/{id}", "StatusesController@detail");
        Route::post("status/add", "StatusesController@store");
        Route::put("status/update/{id}", "StatusesController@update");
        Route::delete("status/delete/{id}", "StatusesController@destroy");

        // (GROUP REQUEST VERIFIEDS)
        Route::get("request/verifieds", "RequestVerifiedsController@index");
        Route::get("request/verified/{id}", "RequestVerifiedsController@detail");
        Route::put("request/verified/update/{id}", "RequestVerifiedsController@update");
        Route::delete("request/verified/delete/{id}", "RequestVerifiedsController@destroy");

        // (GROUP TICKET)
        Route::get("tickets", "TicketsController@index");
        Route::get("ticket/{id}", "TicketsController@detail");
        Route::put("ticket/update/{id}", "TicketsController@update");
        Route::delete("ticket/delete/{id}", "TicketsController@destroy");
    }
);

Route::post('login', 'AuthController@login');
Route::post("register", "AuthController@register");
Route::get("majors", "MajorsController@index");
Route::get("statuses", "StatusesController@index");
