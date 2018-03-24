<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\RedisEvent;

class RedisController extends Controller
{
    public function index()
    {
    	$messages = Message::all();

    	return view('chat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {   
    	$messages = Message::create($request->all());

    	event(
    		$e = new RedisEvent($messages)
    	);

    	return redirect()->back();
    }
}
