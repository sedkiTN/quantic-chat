<?php

namespace App\Http\Controllers;

use Session;
use Request;
use App\Models\User;

class UserController extends Controller
{
    public function store()
    {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::where('email', $attributes['email'])->first();

        if (!$user) {
            $user = User::create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
            ]);
        }

        $currentUser = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
        
        Session::put('currentUser', $currentUser);

        return redirect()->route('sujets.index');
    }
}