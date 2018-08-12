<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $hidden = [
        'password'
    ];

    /**
     * Relationship for: Orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relationship for: Stores
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Always insert the password in a hashed format
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $options = [
            'cost' => 11
        ];

        $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT, $options);
    }
}