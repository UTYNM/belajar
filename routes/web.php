<?php

use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PostTwitterController;
use App\Http\Controllers\PostYoutubeController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\JsonController;

Route::get('/', function () {
    return view('template.admin');
});


//youtube
Route::get('/youtube', [PostYoutubeController::class, 'index'])->name('youtube.index');
Route::get('/youtube/authenticate', [PostYoutubeController::class, 'authenticate'])->name('youtube.authenticate');
Route::get('/youtube/callback', [PostYoutubeController::class, 'callback'])->name('youtube.callback');
Route::post('/youtube/upload', [PostYoutubeController:: class, 'upload'])->name('youtube.upload');

//twitter
// Route::get('/post-tweet', [PostTwitterController::class, 'postTweet']);
Route::get('/twitter', [PostTwitterController::class, 'index'])->name('twitter.index');
Route::post('/post-tweet', [PostTwitterController::class, 'postTweet']);

Route::controller(WordController::class)->group(function () {
    Route::get('/word', 'index');
    Route::get('/word/export', 'export');
});

Route::controller(OperatorController::class)->group(function () {
    Route::get('/operators', 'index');;
    Route::get('/operators/create', 'create');
    Route::post('/operators/store', 'store');
    Route::get('/operators/{operators}/edit', 'edit');
    Route::put('/operators/{operators}/update', 'update');
    Route::get('/operators/{operators}/delete', 'destroy');
});

Route::controller(JsonController::class)->group(function () {
    Route::get('map', 'index');
    Route::post('create', 'create');

});