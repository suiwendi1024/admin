<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,
        SoftDeletes,
        HasCategory,
        HasComments;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_published',
        'is_locked',
    ];

    protected $hidden = [
        'user_id',
    ];

    protected $casts = [
        'is_published' => 'bool',
        'is_locked' => 'bool',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $with = [
        'author',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->getCategoryByType('blog');
    }
}
