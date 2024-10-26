<?php

declare(strict_types=1);

namespace App\Refactor;

class DataLoader
{
    private \PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO('dsn', 'user', 'password');
    }

    public function loadData(string $statement): array
    {
        $query = $this->pdo->prepare($statement);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}