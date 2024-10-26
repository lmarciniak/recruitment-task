<?php

declare(strict_types=1);

namespace App\Service\Report\Filter\Operator;

class In implements OperatorInterface
{
    public function getCondition(string|array $value): string
    {
        $value = array_map(fn ($element) => is_numeric($element) ? $element : "'{$element}'", $value);

        return 'IN (' . implode(',', $value) . ')';
    }
}