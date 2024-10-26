<?php

declare(strict_types=1);

namespace App\Controller;


use App\Service\FormFilter\FilterBuilder;
use App\Service\Report\InvoiceOverpayment;
use App\Service\Report\InvoiceUnderpayment;
use App\Service\Report\InvoiceUnsettled;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;

class ReportController extends AbstractController
{

    public function __construct(protected ServerRequest $request)
    {
        parent::__construct($request);
    }

    public function invoiceOverpayment(): Response
    {
        $invoiceOverpayment = new InvoiceOverpayment($this->request->getQueryParams());

        return $this->render(
            'report/default.phtml',
            [
                'title' => $invoiceOverpayment->getTitle(),
                'rows' => $invoiceOverpayment->fetchData(),
                'filterBuilder' => (new FilterBuilder())->setFilters(
                    $invoiceOverpayment->getConfig()->getFilters()
                ),
                'columns' => $invoiceOverpayment->getColumnsMap(),
            ]
        );
    }

    public function invoiceUnderpayment(): Response
    {
        $invoiceUnderpayment = new InvoiceUnderpayment($this->request->getQueryParams());

        return $this->render(
            'report/default.phtml',
            [
                'title' => $invoiceUnderpayment->getTitle(),
                'rows' => $invoiceUnderpayment->fetchData(),
                'filterBuilder' => (new FilterBuilder())->setFilters(
                    $invoiceUnderpayment->getConfig()->getFilters()
                ),
                'columns' => $invoiceUnderpayment->getColumnsMap(),
            ]
        );
    }

    public function invoiceUnsettled(): Response
    {
        $invoiceUnsettled = new InvoiceUnsettled($this->request->getQueryParams());

        return $this->render(
            'report/default.phtml',
            [
                'title' => $invoiceUnsettled->getTitle(),
                'rows' => $invoiceUnsettled->fetchData(),
                'filterBuilder' => (new FilterBuilder())->setFilters(
                    $invoiceUnsettled->getConfig()->getFilters()
                ),
                'columns' => $invoiceUnsettled->getColumnsMap(),
            ]
        );
    }
}
