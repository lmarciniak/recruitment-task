<?php

declare(strict_types=1);

namespace App\Refactor;

class DefaultTableGeneratorStrategy implements TableGeneratorStrategyInterface
{
    public function calculateQuery(array $params): string
    {
        return "SELECT * FROM contracts WHERE kwota > 10 ORDER BY id";
    }

    public function getTemplatePath(): string
    {
        return 'templates/default.phtml';
    }
}