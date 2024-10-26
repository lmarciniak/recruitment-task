<?php

namespace App\Service\FormFilter;


use App\Lib\View\View;

class FilterBuilder
{
    /**
     * @var array<int, AbstractFormFilter>
     */
    private $filters = [];

    public function render(): self
    {
        $view = new View();
        foreach ($this->filters as $filter) {
            (clone $view)->partial($filter->getTemplatePath(), ['filter' => $filter]);
        }

        return $this;
    }

    public function addFilter(AbstractFormFilter $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @param AbstractFormFilter[] $filters
     */
    public function setFilters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }
}