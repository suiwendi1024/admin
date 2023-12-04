<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasChildren
{
    /**
     * @return void
     */
    protected function initializeHasChildren()
    {
        $this->mergeFillable([
            'parent_id',
        ])->makeHidden([
            'parent_id',
        ]);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(static::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class);
    }
}
