<?php

namespace App;

use App\Furniture;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'furniture_id' => 'integer'
    ];

    /**
     * Get orders's furniture item (one-to-one relationship).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }

    /**
     * Sort orders by created_at date (latest come first).
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
