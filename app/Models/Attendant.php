<?php

namespace App\Models;

use App\Enums\YesNo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendant extends Model
{
    use HasFactory;

    public $fillable = ['meeting_id', 'name', 'willBeAttending', 'note'];

    protected function casts(): array
    {
        return [
            'willBeAttending' => 'boolean',
        ];
    }

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function willBeAttendingText(): string
    {
        if ($this->willBeAttending === true) {
            $text = __(YesNo::Yes->name);
        } elseif ($this->willBeAttending === false) {
            $text = __(YesNo::No->name);
        } else {
            $text = __(YesNo::Unknown->name);
        }

        return $text;
    }
}
