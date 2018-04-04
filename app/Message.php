<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'content'];

    const EVENTS = [
        'MESSAGE' => 'message',
        'TYPING' => 'typing'
    ];
}
