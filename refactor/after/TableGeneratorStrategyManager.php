<?php

declare(strict_types=1);

namespace App\Refactor;

class TableGeneratorStrategyManager
{
    public static function determineStrategy(int $actionId): TableGeneratorStrategyInterface
    {
        return match ($actionId) {
            5 => new FifthTableGeneratorStrategy(),
            default => new DefaultTableGeneratorStrategy()
        };
    }
}