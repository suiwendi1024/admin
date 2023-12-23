<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,
        SoftDeletes,
        HasCategory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'cost',
        'stock',
        'is_available',
        'available_from',
    ];

    protected $hidden = [
        'is_available',
        'available_from',
        'updated_at'
    ];

    protected $casts = [
        'is_available' => 'bool',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->getCategoryByType('shop');
    }
}
