<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'sujet_id',
        'user_id',
        'body'
    ];

    protected $dates = [
        'created_at',
        'deleted_at'
    ];

    public function sujet(): BelongsTo
    {
        return $this->belongsTo(Sujet::class, 'sujet_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'sujet_id', 'sujet_id');
    }

    public function getcreatedAtAttribute($value)
    {
        return Carbon::parse($value)->locale('fr')->diffForHumans();
    }
}