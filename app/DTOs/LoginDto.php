<?php

namespace App\DTOs;

final class LoginDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    )
    {
    }
}
