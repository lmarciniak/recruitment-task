<?php

declare(strict_types=1);

use App\Refactor\DataLoader;
use App\Refactor\TableGeneratorStrategyManager;


$tableGeneratorStrategy = TableGeneratorStrategyManager::determineStrategy($_GET['akcja']);
$dataLoader = new DataLoader();
$rows = $dataLoader->loadData($tableGeneratorStrategy->calculateQuery($_GET));
require_once $tableGeneratorStrategy->getTemplatePath();