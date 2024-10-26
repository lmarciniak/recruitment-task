<?php

declare(strict_types=1);

namespace App\Service\Report\Filter\Operator;

class LessThanOrEqual implements OperatorInterface
{
    public function getCondition(string|array $value): string
    {
        return "<= {$value['max']}";
    }
}