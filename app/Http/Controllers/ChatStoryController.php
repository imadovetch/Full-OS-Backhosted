<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatStory;
use Illuminate\Support\Facades\Storage;

class ChatStoryController extends Controller
{
    public function upload(Request $request)
    {
        $uid = $request->get('userId'); 
        
        $photo = $request->file('photo');
        $randomString = uniqid('', true);  
        $extension = $photo->getClientOriginalExtension();
        $fileName = $randomString . '.' . $extension;
        $photoPath = $photo->storeAs('images', $fileName, 'public');
        

        $expiryDate = now()->addHours(24); 
        $story = new ChatStory();
        $story->creator_id = $uid;
        $story->path = $fileName;
        $story->expiry_date = $expiryDate;
        $story->save();

        return response()->json(['message' => 'File uploaded successfully']);
    }
}
