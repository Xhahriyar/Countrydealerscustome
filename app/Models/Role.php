<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    protected $fillable = [
        'name',
        'guard_name'
    ];

    public function getCreatedAtAttribute($value)
    {
        return dateFormat($value);
    }
}
