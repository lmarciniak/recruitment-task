<?php

declare(strict_types=1);

namespace App\Service\Report;

use App\Lib\Db\Query\Join;
use App\Service\FormFilter\AbstractFormFilter;
use App\Service\FormFilter\NumberFilter;
use App\Service\FormFilter\TextFilter;

class InvoiceUnderpayment extends AbstractReport
{
    public function getTitle(): string
    {
        return 'Invoice Underpayment';
    }

    protected function init(): self
    {
        $this->queryBuilder->select('customer.name, invoice.number, invoice.gross_amount, SUM(COALESCE(payment.amount, 0)) AS paid_amount, 
       (invoice.gross_amount - SUM(COALESCE(payment.amount, 0))) AS underpayment_amount')
            ->from('customer');

        return $this;
    }

    protected function filter(): self
    {
        parent::filter()
            ->queryBuilder
            ->andHaving('(invoice.gross_amount - SUM(COALESCE(payment.amount, 0))) > 0');

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
        $this->queryBuilder->addGroup('customer.id')
            ->addGroup('invoice.id')
            ->addGroup('invoice.gross_amount')
            ->addGroup('invoice.number')
            ->addGroup('payment.amount');

        return $this;
    }

    public function getColumnsMap(): array
    {
        return [
            'name' => 'Customer',
            'number' => 'Invoice number',
            'gross_amount' => 'To pay',
            'paid_amount' => 'Paid',
            'underpayment_amount' => 'Underpayment',
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
                new NumberFilter(
                    'paid_amount',
                    'paid_amount',
                    $this->getColumnsMap()['paid_amount'],
                    $params['paid_amount']['min'] ?? null,
                    $params['paid_amount']['max'] ?? null,
                    AbstractFormFilter::WHERE
                )
            )
            ->addFilter(
                new NumberFilter(
                    'underpayment_amount',
                    '(invoice.gross_amount - SUM(COALESCE(payment.amount, 0)))',
                    $this->getColumnsMap()['underpayment_amount'],
                    $params['underpayment_amount']['min'] ?? null,
                    $params['underpayment_amount']['max'] ?? null,
                    AbstractFormFilter::HAVING
                )
            );
    }
}