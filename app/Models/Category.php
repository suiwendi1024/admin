<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory,
        HasChildren;

    protected $fillable = [
        'type',
        'name',
        'description',
        'order_number',
    ];

    protected $hidden = [
        'type',
        'order_number',
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
