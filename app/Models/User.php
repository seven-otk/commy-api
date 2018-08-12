<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password'
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