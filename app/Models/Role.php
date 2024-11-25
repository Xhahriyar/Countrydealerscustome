<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    protected $fillable = [
        'name',
        'guard_name',
        'logged_in_id',
        'logged_in_name',
        'user_agent',
        'ip_address'
    ];
}
