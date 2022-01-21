<?php

namespace App\Http\Controllers;

use Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Sujet;
use App\Models\Message;
use App\Models\Participant;
use Illuminate\Support\Carbon;

class SujetController extends Controller
{
    public function index()
    {
        return Inertia::render('Liste_sujets', [
            'sujets' => Sujet::with('messages')->latest('updated_at')->paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('Create_sujet');
    }

    public function show($id)
    {
        try {
            $sujet = Sujet::with(['messages'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The sujet with ID: ' . $id . ' was not found.');

            return redirect()->route('sujets.index');
        }

        $sujet->markAsRead(session('currentUser')['id']);

        return Inertia::render('Details_sujet', compact('sujet'));
    }

    public function store()
    {
        $attributes = Request::validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $sujet = Sujet::create([
            'name' => $attributes['subject'],
        ]);

        Message::create([
            'sujet_id' => $sujet->id,
            'user_id' => session('currentUser')['id'],
            'body' => $attributes['message'],
        ]);

        Participant::create([
            'sujet_id' => $sujet->id,
            'user_id' => session('currentUser')['id'],
            'last_read' => new Carbon(),
        ]);

        return redirect()->route('sujets.index');
    }
}