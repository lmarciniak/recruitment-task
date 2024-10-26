<?php

declare(strict_types=1);

namespace App\Service\Report;

use App\Lib\Db\Query\Join;
use App\Service\FormFilter\AbstractFormFilter;
use App\Service\FormFilter\NumberFilter;
use App\Service\FormFilter\TextFilter;

class InvoiceOverpayment extends AbstractReport
{
    public function getTitle(): string
    {
        return 'Invoice Overpayment';
    }

    protected function init(): self
    {
        $this->queryBuilder->select('customer.id, customer.name, customer.bank_account_number, SUM(overpayment.amount) AS overpayment_sum')
            ->from('overpayment');

        return $this;
    }

    protected function join(): self
    {
        $this->queryBuilder
            ->addJoin(new Join(Join::INNER, 'payment', 'overpayment.payment_fkey = payment.id'))
            ->addJoin(new Join(Join::INNER, 'invoice', 'payment.invoice_fkey = invoice.id'))
            ->addJoin(new Join(Join::INNER, 'customer',  'customer.id = invoice.customer_fkey'));

        return $this;
    }

    protected function group(): self
    {
        $this->queryBuilder->addGroup('customer.id');

        return $this;
    }

    public function getColumnsMap(): array
    {
        return [
            'name' => 'Customer',
            'bank_account_number' => 'Bank Account',
            'overpayment_sum' => 'Overpayment',
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
                    'bank_account_number',
                    'customer.bank_account_number',
                    $this->getColumnsMap()['bank_account_number'],
                    $params['bank_account_number']['min'] ?? null,
                    $params['bank_account_number']['max'] ?? null,
                    AbstractFormFilter::HAVING
                )
            )
            ->addFilter(
                new NumberFilter(
                    'overpayment_sum',
                    'SUM(overpayment.amount)',
                    $this->getColumnsMap()['overpayment_sum'],
                    $params['overpayment_sum']['min'] ?? null,
                    $params['overpayment_sum']['max'] ?? null,
                    AbstractFormFilter::HAVING
                )
            );
    }
}