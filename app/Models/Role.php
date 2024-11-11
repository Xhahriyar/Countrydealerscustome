<?php

namespace App\Models;

class Roles extends \Spatie\Permission\Models\Role
{
    protected $fillable = [
        'name',
        'guard_name'
    ];

    // public function getCreatedAtAttribute($value)
    // {
    //     return dateFormat($value);
    // }
}
