<?php

namespace App\Http\Controllers\CHAT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\User;
class Respondeonrequest extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->get('userId'); 
        $requestData = $request->json()->all();
        $friendId = $requestData['id'];
        $status = $requestData['status'];

        if ($status === 1) {

            Friendship::where('user2_id', $userId)
                ->where('user1_id', $friendId)
                ->update(['status' => 'accepted']);
        } elseif ($status === 0) {

            Friendship::where('user2_id', $userId)
                ->where('user1_id', $friendId)
                ->delete();
        }

        return response()->json(['message' => 'Request processed successfully']);
}
}