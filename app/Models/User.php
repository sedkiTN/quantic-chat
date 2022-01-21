<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function sujets()
    {
        return $this->belongsToMany(Sujet::class, 'participants', 'user_id', 'sujet_id');
    }
}