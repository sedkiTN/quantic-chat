<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'participants';

    protected $fillable = [
        'sujet_id',
        'user_id',
        'last_read'
    ];

    protected $dates = [
        'deleted_at',
        'last_read'
    ];

    public function sujet(): BelongsTo
    {
        return $this->belongsTo(Sujet::class, 'sujet_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLastReadAttribute($value)
    {
        return Carbon::parse($value)->locale('fr')->diffForHumans();
    }
}