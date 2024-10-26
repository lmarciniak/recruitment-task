<?php

declare(strict_types=1);

namespace App\Service\FormFilter;

use App\Enum\Filter\OperatorEnum;

class TextFilter extends AbstractFormFilter
{
    public function getTemplatePath(): string
    {
        return 'filter/text.phtml';
    }

    public function getQueryFilterOperator(): OperatorEnum
    {
        return OperatorEnum::ILIKE;
    }
}