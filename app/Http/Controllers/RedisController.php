<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\RedisEvent;

class RedisController extends Controller
{
    public $length = 10;

    public function getLastMessages($length)
    {
        return Message::orderBy('id', 'desc')->take($length)->get();
    }
    public function index()
    {
        $messages = $this->getLastMessages($this->length);

        return view('chat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $messages = Message::create($request->all());

        event(
            $e = new RedisEvent($messages, 'sda')
        );

        $messages = $this->getLastMessages($this->length);

        return view('chat-partial', compact('messages'));
    }

    public function getMessage(Request $request)
    {
        $messages = $this->getLastMessages($this->length);

        return view('chat-partial', compact('messages'));
    }
}
