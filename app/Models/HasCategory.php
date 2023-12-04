<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCategory
{
    /**
     * @return void
     */
    protected function initializeHasCategory()
    {
        $this->mergeFillable([
            'category_id',
        ])->makeHidden([
            'category_id',
        ]);
    }

    /**
     * @return BelongsTo
     */
    public function getCategoryByType(string $type): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')
            ->where('type', $type);
    }
}
