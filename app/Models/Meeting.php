<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;

    public $fillable = ['name', 'when', 'where', 'slug', 'user_id'];

    protected function casts(): array
    {
        return [
            'when' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function (Meeting $meeting) {
            $meeting->user_id = Auth::id();
            $meeting->slug = Str::slug($meeting->name);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
