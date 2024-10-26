<?php

declare(strict_types=1);

namespace App\Refactor;

interface TableGeneratorStrategyInterface
{
    public function calculateQuery(array $params): string;

    public function getTemplatePath(): string;
}