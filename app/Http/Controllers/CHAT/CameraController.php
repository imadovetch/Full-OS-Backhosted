<?php

namespace App\Http\Controllers\CHAT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friendship;
use App\Models\GalleryPhoto;
use App\Models\Stokage;
use Illuminate\Support\Facades\Storage;

class CameraController extends Controller
{

  public function index(Request $request)
  {
    $photo = $request->file('photo');
    $id = $request->get('userId'); 
    
    if ($photo !== null) {  
      $fileSize = $photo->getSize() / 1024 / 1024;  
        $randomString = uniqid('', true);  
        $extension = $photo->getClientOriginalExtension();
        $fileName = $randomString . '.' . $extension;
        $photoPath = $photo->storeAs('images', $fileName, 'public');  


        $galleryPhoto = new GalleryPhoto();
        $galleryPhoto->user_id = $id; 
        $galleryPhoto->text = $fileName; 
        $galleryPhoto->source = 'camera';
        $galleryPhoto->save();


        $existingStokage = Stokage::where('user_id', $id)->first();

        if ($existingStokage) {
            $existingStokage->size += round($fileSize, 2);
            $existingStokage->save();
        } else {
            $stokage = new Stokage();
            $stokage->user_id = $id;
            $stokage->size = round($fileSize, 2);  
            $stokage->save();
        }

        return response()->json([
            'message' => 'Photo uploaded successfully!',
            'file_size' => number_format($fileSize, 2) . ' MB',
            'file_name' => $fileName,
            'photo_path' => $photoPath
        ]);
    } else {
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
  }
}
