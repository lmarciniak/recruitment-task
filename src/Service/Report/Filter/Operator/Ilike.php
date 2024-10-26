<?php

declare(strict_types=1);

namespace App\Service\Report\Filter\Operator;

class Ilike implements OperatorInterface
{
    public function getCondition(array|string $value): string
    {
        return "ILIKE '%{$value['min']}%'";
    }
}