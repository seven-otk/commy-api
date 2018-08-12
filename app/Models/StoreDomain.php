<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreDomain extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    /**
     * Relationship for: Stores
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}