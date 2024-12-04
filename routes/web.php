<?php

use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PostTwitterController;
use App\Http\Controllers\OpdController;
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
    Route::get('/operator', 'index');;
    Route::get('/operator/create', 'create');
    Route::post('/operator/store', 'store');
    Route::get('/operator/{operator}/edit', 'edit');
    Route::put('/operator/{operator}/update', 'update');
    Route::get('/operator/{operator}/delete', 'destroy');
});

Route::controller(JsonController::class)->group(function () {
    Route::get('map', 'index');
    Route::post('create', 'create');

});