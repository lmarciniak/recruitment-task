<?php

use App\Controller\DashboardController;
use App\Controller\ReportController;
use App\Lib\Router\Route;
use App\Lib\Router\RouteCollection;

$routeCollection = new RouteCollection();
$routeCollection->addRoute(new Route('/', DashboardController::class, 'index'))
    ->addRoute(new Route('/report/invoice-overpayment', ReportController::class, 'invoiceOverpayment'))
    ->addRoute(new Route('/report/invoice-underpayment', ReportController::class, 'invoiceUnderpayment'))
    ->addRoute(new Route('/report/invoice-unsettled', ReportController::class, 'invoiceUnsettled'));