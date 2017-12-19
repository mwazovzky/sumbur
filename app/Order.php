<?php

namespace App;

use App\Furniture;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    /**
     * Get orders's furniture item (one-to-one relationship).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
