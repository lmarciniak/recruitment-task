<?php

declare(strict_types=1);

namespace App\Service\Report\Filter;

use App\Service\FormFilter\AbstractFormFilter;

class FilterBuilder
{
    /**
     * @var array<string, array<int, Filter>>
     */
    private array $filters = [];

    public function addFilter(Filter $filter): self
    {
        $this->filters[$filter->getType()][] = $filter;

        return $this;
    }

    public function build(): array
    {
        $result = [
            AbstractFormFilter::WHERE => '',
            AbstractFormFilter::HAVING => ''
        ];
        foreach ($this->filters as $type => $filters) {
            $result[$type] = implode(' AND ', $filters);
        }

        return $result;
    }

    public function addFromFormFilters(AbstractFormFilter ...$formFilters): self
    {
        foreach ($formFilters as $oneFormFilter) {
            if (empty($oneFormFilter->getData()['min']) && empty($oneFormFilter->getData()['max'])) {
                continue;
            }
            $this->addFilter(
                new Filter(
                    $oneFormFilter->getColumn(),
                    $oneFormFilter->getQueryFilterOperator(),
                    $oneFormFilter->getData(),
                    $oneFormFilter->getType()
                )
            );
        }

        return $this;
    }
}