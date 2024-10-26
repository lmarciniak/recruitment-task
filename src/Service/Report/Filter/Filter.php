<?php

declare(strict_types=1);

namespace App\Service\Report\Filter;

use App\Enum\Filter\OperatorEnum;
use App\Service\Report\Filter\Operator\Between;
use App\Service\Report\Filter\Operator\Equal;
use App\Service\Report\Filter\Operator\GreaterThan;
use App\Service\Report\Filter\Operator\GreaterThanOrEqual;
use App\Service\Report\Filter\Operator\Ilike;
use App\Service\Report\Filter\Operator\In;
use App\Service\Report\Filter\Operator\LessThan;
use App\Service\Report\Filter\Operator\LessThanOrEqual;
use App\Service\Report\Filter\Operator\OperatorInterface;

class Filter
{
    private OperatorInterface $operatorHandler;

    public function __construct(
        private readonly string       $column,
        private readonly OperatorEnum $operator,
        private readonly string|array $value,
        private readonly string       $type
    )
    {
        $this->operatorHandler = new ($this->getHandlerClassForOperator());
    }

    public function __toString(): string
    {
        return "{$this->column} {$this->operatorHandler->getCondition($this->value)}";
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): array|string
    {
        return $this->value;
    }

    public function getOperator(): OperatorEnum
    {
        return $this->operator;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    protected function getHandlerClassForOperator(): string
    {
        return match ($this->operator->value) {
            OperatorEnum::BETWEEN->value => Between::class,
            OperatorEnum::IN->value => In::class,
            OperatorEnum::GREATER_THAN->value => GreaterThan::class,
            OperatorEnum::GREATER_THAN_OR_EQUAL->value => GreaterThanOrEqual::class,
            OperatorEnum::LESS_THAN->value => LessThan::class,
            OperatorEnum::LESS_THAN_OR_EQUAL->value => LessThanOrEqual::class,
            OperatorEnum::ILIKE->value => Ilike::class,
            default => Equal::class,
        };
    }
}
