<?php

namespace App\Http\Controllers\CHAT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\User;

class PendingRequests extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('userId'); 
        
        $pendingRequests = Friendship::where('user2_id', $id)
                                    ->whereNull('status')
                                    ->get();
        
        $users = [];
        
        foreach ($pendingRequests as $request) {
        $user = User::select('id', 'name', 'email')->find($request->user1_id);
        if ($user) {
        $users[] = $user;
        }
        }
                            
        return response()->json($users);
    }
}