<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatStory;
use Carbon\Carbon;

class GetStories extends Controller
{
    public function index()
    {

        $currentTime = Carbon::now();

        $twentyFourHoursAgo = $currentTime->copy()->subHours(24);

        $stories = ChatStory::where('created_at', '>=', $twentyFourHoursAgo)->get();

        return response()->json($stories);
    }
}
