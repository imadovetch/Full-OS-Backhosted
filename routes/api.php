<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CHAT\NonFriendController;
use App\Http\Controllers\CHAT\FriendsRequests;
use App\Http\Controllers\CHAT\PendingRequests;
use App\Http\Controllers\CHAT\Respondeonrequest;
use App\Http\Controllers\CHAT\Getconversations;
use App\Http\Controllers\CHAT\CameraController;
use App\Http\Controllers\GeneralNotifications;
use App\Http\Controllers\UserSettings;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FetchForGallery;
// CHAT APP


Route::middleware('verifyUser')->group(function () {
    Route::post('/nonfriends', [NonFriendController::class, 'index']);
    Route::post('/sendrequest', [FriendsRequests::class, 'index']);
    Route::post('/PendingRequests', [PendingRequests::class, 'index']);
    Route::post('/respondeonreq', [Respondeonrequest::class, 'index']);
    Route::post('/getconversations', [Getconversations::class, 'index']);
    Route::post('/createnotification', [GeneralNotifications::class, 'index']);
    Route::post('/updateusersettings', [UserSettings::class, 'index']);
    Route::post('/save-camera-photo', [CameraController::class, 'index']);
    Route::post('/FetchForGallery', [FetchForGallery::class, 'index']);
});
Route::get('/images/{filename}', function ($filename) {
    $path = Storage::disk('public')->path('images/' . $filename);

    if (!Storage::disk('public')->exists('images/' . $filename)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');


// Routes not affected by the middleware
Route::get('/test', function () {
    return response()->json(['fvyuhkg' => 'gbyuigil']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

