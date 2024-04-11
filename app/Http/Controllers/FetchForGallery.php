<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryPhoto;
class FetchForGallery extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('userId'); 
        $photos = GalleryPhoto::where('user_id', $id)->get();

        return response()->json(['photos' => $photos]);
    }
}
