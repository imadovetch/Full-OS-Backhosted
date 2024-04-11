<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class UserSettings extends Controller
{
    public function index(Request $request){
        $id = $request->get('userId'); 
        $requestdata = $request->json()->all();
        $for = $requestdata['type'];
        
        if($for == 'chat'){
            $notifupdate = $requestdata['chatnotif'];
            
            $settings = Settings::where('user_id', $id)->first();

            if($settings){
                $settings->chat = $notifupdate;
                $settings->save();
                return response()->json(['message'=>'updated successfully']);
            } else{
                return response()->json(['message'=>'you doesnt exist man']);
                $newSettings = new Settings();
                $newSettings->user_id = $id;
                $newSettings->chat = $notifupdate;
                $newSettings->save();
            }
        } else {
            return response()->json(['message'=>'bad request']);
        }
    }
}
