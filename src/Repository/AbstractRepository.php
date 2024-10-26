<?php

declare(strict_types=1);

namespace App\Repository;

use App\Lib\Db\Connection;
use PDO;

abstract class AbstractRepository
{
    public function query(string $statement, array $parameters = [], int $mode = PDO::FETCH_ASSOC): array|false
    {
        $query = (Connection::getInstance())->getPdo()
            ->prepare($statement);
        $query->execute($parameters);

        return $query->fetchAll($mode);
    }
}