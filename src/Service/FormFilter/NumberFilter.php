<?php

declare(strict_types=1);

namespace App\Service\FormFilter;

class NumberFilter extends AbstractFormFilter
{
    public function getTemplatePath(): string
    {
        return 'filter/number.phtml';
    }
}