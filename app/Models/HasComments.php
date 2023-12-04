<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasComments
{
    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
