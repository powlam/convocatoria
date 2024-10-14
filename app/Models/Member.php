<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    public $fillable = ['group_id', 'name'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
