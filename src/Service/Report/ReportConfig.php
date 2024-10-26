<?php

declare(strict_types=1);

namespace App\Service\Report;

use App\Service\FormFilter\AbstractFormFilter;

class ReportConfig
{
    public function __construct(protected array $filters = [], protected string $sort = '')
    {

    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function setFilters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

    public function getSort(): string
    {
        return $this->sort;
    }

    public function setSort(string $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function addFilter(AbstractFormFilter $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }
}