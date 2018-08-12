<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Relationship for: Customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship for: Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Relationship for: Store Locations
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storeLocation()
    {
        return $this->belongsTo(StoreLocation::class);
    }

    /**
     * Relationship for: Order Statuses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(OrderStatus::class);
    }
}