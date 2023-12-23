<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCategory
{
    /**
     * @return void
     */
    protected static function bootHasCategory(): void
    {
        static::addGlobalScope('category', function (Builder $builder) {
            $builder->with('category');
        });
    }

    /**
     * @return void
     */
    protected function initializeHasCategory(): void
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
    abstract public function category(): BelongsTo;

    /**
     * @param  string  $type
     * @return BelongsTo
     */
    public function getCategoryByType(string $type): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')
            ->where('type', $type);
    }
}
