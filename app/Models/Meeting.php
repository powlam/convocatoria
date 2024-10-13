<?php

namespace App\Models;

use App\Enums\YesNo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $meeting->user_id ??= Auth::id();
            $meeting->slug = Str::slug($meeting->name);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendants(): HasMany
    {
        return $this->hasMany(Attendant::class);
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('meeting', ['meeting' => $this]),
        );
    }

    /**
     * @return array<string, int> Keys are 'Y', 'N' and 'UNK'
     */
    public function attendantsWillBeAttending(): array
    {
        $numbers = $this->attendants()
            ->select('willBeAttending', DB::raw('count(*) as number'))
            ->groupBy('willBeAttending')
            ->pluck('number', 'willBeAttending');

        return [
            YesNo::Yes->name => $numbers[true] ?? 0,
            YesNo::No->name => $numbers[false] ?? 0,
            YesNo::Unknown->name => $numbers[''] ?? 0,
        ];
    }
}
