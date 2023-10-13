<?php

namespace App\Core\Constants;

use App\Core\Utils\Enum;

class HasProductsAndKits extends Enum
{
    const YES = 'yes';
    const NO = 'no';

    static $labels = [
        self::YES => 'Sim',
        self::NO => 'Não',
    ];
}
