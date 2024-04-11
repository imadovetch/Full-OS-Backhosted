<?php

namespace App\Http\Controllers\CHAT;

use App\Models\Friendship;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NonFriendController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->get('userId'); 
        
        $friendsIds = Friendship::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->pluck('user1_id', 'user2_id')
            ->toArray();

        $nonFriends = User::whereNotIn('id', array_keys($friendsIds))
            ->where('id', '!=', $userId)
            ->get();

        // Map the retrieved users into the desired format
        $formattedNonFriends = $nonFriends->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
            ];
        });

        return response()->json($formattedNonFriends);
    }
    public function test()
{
    return response()->json(['message' => User::all()]);
}

}
