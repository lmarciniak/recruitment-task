<?php

declare(strict_types=1);

namespace App\Lib\Db;

use PDO;

class Connection
{
    private PDO $pdo;

    private static Connection $instance;

    private function __construct()
    {
        $this->pdo = new PDO(
            sprintf(
                '%s:host=%s;port=%d;dbname=%s;',
                DB_DRIVER,
                DB_HOST,
                DB_PORT,
                DB_NAME,
            ),
            DB_USER,
            DB_PASS
        );
    }

    public static function getInstance(): Connection
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}