<?php

use App\Http\Controllers\UploadVideoController;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('channels', 'ChannelController');

Route::get('videos/{video}',  [VideoController::class, 'show']);
Route::put('videos/{video}',  [VideoController::class, 'updateViews']);
Route::put('videos/{video}/update',  [VideoController::class, 'update'])->middleware('auth')->name('videos.update');
Route::get('videos/{video}/comments', 'CommentController@index');


Route::post('channels/{channel}/videos', [UploadVideoController::class, 'store']);
Route::get('channels/{channel}/videos', [UploadVideoController::class, 'index'])->name('channel.upload');
Route::resource('channels/{channel}/subscriptions', 'SubscriptionController');
Route::post('votes/{video}/{type}', 'VoteController@vote')->name('user.vote');
