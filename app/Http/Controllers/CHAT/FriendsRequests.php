<?php

namespace App\Http\Controllers\CHAT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friendship;

class FriendsRequests extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->get('userId');
        $requestData = $request->json()->all();
        $friendId = $requestData['friendId'] ?? null;
        
        if (!$friendId) {
            return response()->json(['error' => 'Friend ID not provided', 'requester' => $userId], 400);
        }

        $existingFriendship = Friendship::where(function ($query) use ($userId, $friendId) {
            $query->where('user1_id', $userId)->where('user2_id', $friendId)
                ->orWhere('user1_id', $friendId)->where('user2_id', $userId);
        })->first();
        
        if ($existingFriendship) {
            return response()->json(['error' => 'Friendship already exists', 'requester' => $userId], 400);
        }

        Friendship::create([
            'user1_id' => $userId,
            'user2_id' => $friendId,
        ]);
        
        return response()->json(['message' => 'Friend added successfully', 'requester' => $userId], 200);
    }
}
