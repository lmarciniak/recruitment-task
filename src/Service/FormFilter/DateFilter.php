<?php

namespace App\Service\FormFilter;

class DateFilter extends AbstractFormFilter
{
    public function getTemplatePath(): string
    {
        return 'filter/date.phtml';
    }

    public function getMin(): ?string
    {
        return !empty($this->min) ? "'{$this->min}'" : null;
    }

    public function getMax(): ?string
    {
        return !empty($this->max) ? "'{$this->max}'" : null;
    }
}