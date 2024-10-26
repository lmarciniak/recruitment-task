<?php

declare(strict_types=1);

namespace App\Service\Report\Filter\Operator;

interface OperatorInterface
{
    public function getCondition(string|array $value): string;
}