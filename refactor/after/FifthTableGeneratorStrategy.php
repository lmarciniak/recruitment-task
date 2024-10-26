<?php

declare(strict_types=1);

namespace App\Refactor;

class FifthTableGeneratorStrategy implements TableGeneratorStrategyInterface
{
    public function calculateQuery(array $params): string
    {
        // show contracts with amount more than 10
        $order = $this->calculateOrder($params);

        return 'SELECT * FROM contracts WHERE kwota > 10 '
            . (empty($order) ? '' : $order);
    }

    public function getTemplatePath(): string
    {
        return 'templates/fifth.phtml';
    }

    private function calculateOrder(array $params): ?string
    {
        // 0 => id, 2 => nazwa przedsiebiorcy, 4 => NIP, 10 => kwota,
        return match ($params['sort']) {
            1 => 'nazwa_przedsiebiorcy, NIP DESC',
            2 => 'kwota',
            default => null,
        };
    }
}