<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRoles: string
{
    case Admin = 'ROLE_ADMIN';
    case User = 'ROLE_USER';
}
