<?php

declare(strict_types=1);

namespace App\Service\FormFilter;

use App\Enum\Filter\OperatorEnum;

abstract class AbstractFormFilter
{
    public const WHERE = 'WHERE';
    public const HAVING = 'HAVING';

    public function __construct(
        protected readonly string  $name,
        protected readonly string  $column,
        protected readonly string  $displayName,
        protected readonly ?string $min = null,
        protected readonly ?string $max = null,
        protected readonly ?string $type = self::WHERE
    )
    {

    }

    abstract public function getTemplatePath(): string;

    public function getQueryFilterOperator(): OperatorEnum
    {
        if (!empty($this->getMin()) && empty($this->getMax())) {
            return OperatorEnum::GREATER_THAN_OR_EQUAL;
        } elseif (empty($this->getMin()) && !empty($this->getMax())) {
            return OperatorEnum::LESS_THAN_OR_EQUAL;
        }

        return OperatorEnum::BETWEEN;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getMin(): ?string
    {
        return $this->min;
    }

    public function getMax(): ?string
    {
        return $this->max;
    }

    public function getData(): array
    {
        return ['min' => $this->getMin(), 'max' => $this->getMax()];
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getColumn(): string
    {
        return $this->column;
    }
}