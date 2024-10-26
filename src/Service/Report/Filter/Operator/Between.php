<?php

declare(strict_types=1);

namespace App\Service\Report\Filter\Operator;

class Between implements OperatorInterface
{
    public function getCondition(string|array $value): string
    {
        return "BETWEEN {$value['min']} AND {$value['max']}";
    }
}