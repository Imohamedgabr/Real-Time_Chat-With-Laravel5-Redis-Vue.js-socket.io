<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Message;
use App\User;
use Auth;
use App\Events\UserSignedUp;

class MessagesController extends Controller
{

	public function getMessages(Request $request)
	{
		// you need this requeest so u can return
		// the view with the value in the url
		// so u can get it with the javascrpit and send it with get request
		$id = $request->get('user_id');

    	return view('chat');
	}

    public function returnMessages($id)
    {

    	// dd($id);

    	$messages1 = array();

    	$m1 = Message::where('user_id', $id)
					->where('receiver_id', Auth::id())
					->get();


		foreach($m1 as $message):
			array_push($messages1, array( 
					   "sender" => User::find($message->user_id)->name ,
					   "reciever" => User::find($message->receiver_id)->name ,
					   "content" => $message->content 			    
					));
		endforeach;


		$messages2 = array();

		$m2 = Message::where('receiver_id', $id)
					->where('user_id', Auth::id())
					->get();

		foreach($m2 as $message):
			array_push($messages2, array( 
					   "sender" => User::find($message->user_id)->name ,
					   "reciever" => User::find($message->receiver_id)->name ,
					   "content" => $message->content 			    
					));
		endforeach;

		$messages = array_merge($messages1, $messages2);
    	return $messages;
    	
    }

    public function sendMessages(Request $reuqest,$id)
    {
        // recieve data 
        // just replace user name with the authenticated user name
        $message = new Message;
        $message->user_id = Auth::id();
        $message->receiver_id = $id;
        $message->content = $reuqest->message;

        $arr = array('sender_id' => $message->user_id,'sender'=> User::find($message->user_id)->name, 'receiver_id' =>$message->receiver_id, 'content' => $message->content);

        
        $message->save(); 
        event(new UserSignedUp($arr));
        // $arr = array('sender' => $message->user_id, 'receiver_id' =>$message->receiver_id, 'content' => $message->content);
             
    	// publish the data
    	// dd($message);
    	// event(new UserSignedUp($message));
    	// return response()->json(['message'=>$message]);
    }
}
