<?php

declare(strict_types=1);

namespace App\Service\Report;

use App\Lib\Db\Query\Join;
use App\Service\FormFilter\AbstractFormFilter;
use App\Service\FormFilter\DateFilter;
use App\Service\FormFilter\NumberFilter;
use App\Service\FormFilter\TextFilter;

class InvoiceUnsettled extends AbstractReport
{
    public function getTitle(): string
    {
        return 'Invoice Unsettled';
    }

    protected function init(): self
    {
        $this->queryBuilder->select('customer.name, invoice.number, invoice.gross_amount, invoice.payment_date AS invoice_payment_date, payment.amount, payment.payment_date AS payment_payment_date')
            ->from('customer');

        return $this;
    }

    protected function filter(): self
    {
        parent::filter()
            ->queryBuilder
            ->andWhere('invoice.gross_amount > payment.amount');

        return $this;
    }

    protected function join(): self
    {
        $this->queryBuilder
            ->addJoin(new Join(Join::INNER, 'invoice', 'customer.id = invoice.customer_fkey'))
            ->addJoin(new Join(Join::INNER, 'payment', 'payment.invoice_fkey = invoice.id'));

        return $this;
    }

    protected function group(): self
    {
        return $this;
    }

    public function getColumnsMap(): array
    {
        return [
            'name' => 'Customer',
            'number' => 'Invoice number',
            'gross_amount' => 'To pay',
            'invoice_payment_date' => 'Payment date',
            'amount' => 'Paid',
            'payment_payment_date' => 'Paid date',
        ];
    }

    public function createFromParams(array $params = []): ReportConfig
    {
        return (new ReportConfig())
            ->addFilter(
                new TextFilter(
                    'name',
                    'name',
                    $this->getColumnsMap()['name'],
                    $params['name']['min'] ?? null,
                    $params['name']['max'] ?? null,
                    AbstractFormFilter::WHERE
                )
            )
            ->addFilter(
                new TextFilter(
                    'number',
                    'number',
                    $this->getColumnsMap()['number'],
                    $params['number']['min'] ?? null,
                    $params['number']['max'] ?? null,
                    AbstractFormFilter::WHERE
                )
            )
            ->addFilter(
                new NumberFilter(
                    'gross_amount',
                    'gross_amount',
                    $this->getColumnsMap()['gross_amount'],
                    $params['gross_amount']['min'] ?? null,
                    $params['gross_amount']['max'] ?? null,
                    AbstractFormFilter::WHERE
                )
            )
            ->addFilter(
                new DateFilter(
                    'invoice_payment_date',
                    'invoice.payment_date',
                    $this->getColumnsMap()['invoice_payment_date'],
                    $params['invoice_payment_date']['min'] ?? null,
                    $params['invoice_payment_date']['max'] ?? null,
                    AbstractFormFilter::WHERE
                )
            )
            ->addFilter(
                new NumberFilter(
                    'amount',
                    'amount',
                    $this->getColumnsMap()['amount'],
                    $params['paid_amount']['min'] ?? null,
                    $params['paid_amount']['max'] ?? null,
                    AbstractFormFilter::WHERE
                )
            )
            ->addFilter(
                new DateFilter(
                    'payment_payment_date',
                    'payment.payment_date',
                    $this->getColumnsMap()['payment_payment_date'],
                    $params['payment_payment_date']['min'] ?? null,
                    $params['payment_payment_date']['max'] ?? null,
                    AbstractFormFilter::WHERE
                )
            );
    }
}