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
    	 // $message = '';
    	 // $message = $request->message;
    	// recieve data 
    	// publish the data
    	// dd($message);
    	event(new UserSignedUp($reuqest->message));
    	// return response()->json(['message'=>$message]);
    }
}
