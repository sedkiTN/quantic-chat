<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Message;
use App\Models\Participant;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{
    public function store()
    {
        $attributes = Request::validate([
            'message' => 'required',
            'id' => 'required'
        ]);

        Message::create([
            'sujet_id' => $attributes['id'],
            'user_id' => session('currentUser')['id'],
            'body' => $attributes['message'],
        ]);

        Participant::create([
            'sujet_id' => $attributes['id'],
            'user_id' => session('currentUser')['id'],
            'last_read' => new Carbon(),
        ]);

        return redirect()->route('sujets.show', ['id' => $attributes['id']]);
    }
}