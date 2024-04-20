<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class tool extends Model
{
    use HasFactory;
    protected $fillable = [

        'name', 'description', 'category_id',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function loan(): HasOne
    {
        return $this->hasOne(loan::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

}
