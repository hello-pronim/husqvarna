<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Admin()
 * @method static static Warehouse() 
 */
final class UserType extends Enum
{
    const Admin =   1;
    const Warehouse =   2;    
}
