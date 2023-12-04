<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,
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
        'available_from' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->getCategoryByType('shop');
    }
}
