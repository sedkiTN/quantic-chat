<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sujet extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'sujets';

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    protected $appends = [
        'latestMessage',
    ];

    public function getcreatedAtAttribute($value)
    {
        return Carbon::parse($value)->locale('fr')->diffForHumans();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sujet_id', 'id')->with('user');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'sujet_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'sujet_id', 'user_id')->as('participants');
    }

    /**
     * Returns the latest message from a sujet.
     */
    public function getlatestMessageAttribute()
    {
        return $this->messages()->latest()->first();
    }

    /**
     * Mark a sujet as read for a user.
     */
    public function markAsRead($userId): void
    {
        try {
            $participant = $this->getParticipantFromUser($userId);
            $participant->last_read = new Carbon();
            $participant->save();
        } catch (\Exception $e) {
            
        }
    }
}