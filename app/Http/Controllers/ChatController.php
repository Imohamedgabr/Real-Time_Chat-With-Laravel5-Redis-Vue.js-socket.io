<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserSignedUp;

class ChatController extends Controller
{
    public function showMessages()
    {
    	return view('chat');
    }

    public function sendMessages(Request $reuqest)
    {
        // recieve data 
        // just replace user name with the authenticated user name
    	$array = array( 
                "username" => $reuqest->username, 
                "message" => $reuqest->message
            ); 
    	// publish the data
    	// dd($message);
    	event(new UserSignedUp($array));
    	// return response()->json(['message'=>$message]);
    }
}
