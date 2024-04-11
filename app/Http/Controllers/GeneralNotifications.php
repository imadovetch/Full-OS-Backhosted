<?php

namespace App\Http\Controllers;
use App\Models\notifications;
use Illuminate\Http\Request;

class GeneralNotifications extends Controller
{
    public function index(Request $request){
        $requestData = $request->json()->all();
        $userId = $request->get('userId'); 
        $dummyNotification = [
            'user_id' => $userId, // Example user ID
            'content' => 'This is a dummy notification.',
            'type' => 'dummy',
            'seen' => 'no',
        ];
        notifications::create($dummyNotification);
        return response()->json(["hi"=>"hi"]);
    }
}
