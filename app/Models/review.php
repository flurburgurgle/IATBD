<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewed_user_id', 'content', 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
