<?php

namespace App\Http\Controllers\CHAT;
use App\Models\Friendship;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Getconversations extends Controller
{
    public function index(Request $request)
    {
        
        $userId = $request->get('userId'); 

        $friendships = Friendship::where(function ($query) use ($userId) {
            $query->where('user1_id', $userId)
                  ->orWhere('user2_id', $userId);
        })
        ->where('status', 'accepted')
        ->get();

        $friendIds = $friendships->map(function ($friendship) use ($userId) {
            return $friendship->user1_id == $userId ? $friendship->user2_id : $friendship->user1_id;
        })->toArray();

        $friends = User::whereIn('id', $friendIds)->select('id', 'UniqueId', 'name', 'email', 'avatar')->get();

        return response()->json($friends);
    }
}
