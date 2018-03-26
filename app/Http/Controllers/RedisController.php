<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\RedisEvent;

class RedisController extends Controller
{
    public $length = 10;
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->take(5)->get();

        return view('chat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $messages = Message::create($request->all());

        event(
            $e = new RedisEvent($messages)
        );

        $messages = Message::orderBy('id', 'desc')->take(5)->get();

        return view('chat-partial', compact('messages'));
    }
}
