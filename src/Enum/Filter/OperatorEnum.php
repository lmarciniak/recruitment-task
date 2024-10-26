<?php

declare(strict_types=1);

namespace App\Enum\Filter;

enum OperatorEnum: string
{
    case GREATER_THAN = '>';
    case LESS_THAN = '<';
    case GREATER_THAN_OR_EQUAL = '>=';
    case LESS_THAN_OR_EQUAL = '<=';
    case EQUAL = '=';
    case BETWEEN = 'BETWEEN';
    case IN = 'IN';
    case ILIKE = 'ILIKE';
}
