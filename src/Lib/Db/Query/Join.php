<?php

declare(strict_types=1);

namespace App\Lib\Db\Query;

class Join
{
    public const string LEFT = 'LEFT';
    public const string RIGHT = 'RIGHT';
    public const string INNER = 'INNER';
    public const string OUTER = 'OUTER';

    public function __construct(
        private readonly string $type,
        private readonly string $table,
        private readonly string $condition
    )
    {

    }

    public function __toString(): string
    {
        return "{$this->type} JOIN {$this->table} ON {$this->condition}";
    }
}