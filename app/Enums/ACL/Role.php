<?php

namespace App\Enums\ACL;

/**
 *
 */
enum Role:string
{
    /**
     *
     */
    case ADMIN = 'admin';
    /**
     *
     */
    case C2C = 'c2c';
    /**
     *
     */
    case C2B = 'c2b';
}
