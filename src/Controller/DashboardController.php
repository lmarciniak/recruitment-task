<?php

declare(strict_types=1);

namespace App\Controller;

class DashboardController extends AbstractController
{
    public function index()
    {
        return $this->render('dashboard/index.phtml');
    }
}
