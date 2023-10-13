<?php

namespace App\Core\Constants;

use App\Core\Utils\Enum;

class ExtraProduct extends Enum
{
    const YES = 'yes';
    const NO = 'no';

    static $labels = [
        self::YES => 'Sim',
        self::NO => 'Não',
    ];
}
