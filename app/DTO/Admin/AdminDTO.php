<?php

namespace App\DTO\Admin;

class AdminDTO
{
    /**
     * AdminDTO constructor.
     *
     * @param $name
     */
    public function __construct(
        public string $name,
        public string $email,
        public ?string $role = null,
        public ?string $password = null,
        public ?string $verify_token = null,
    ) {
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
