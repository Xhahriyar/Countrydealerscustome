<?php

namespace App\DTO\Roles;

class RoleDTO
{
    /**
     * RoleDTO constructor.
     *
     * @param $name
     */
    public function __construct(
        public ?string $name = null,
        public ?string $guard_name = null
    ) {
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
