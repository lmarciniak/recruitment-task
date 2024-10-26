<?php

declare(strict_types=1);

namespace App\Service\Report;

use App\Lib\Db\Query\QueryBuilder;
use App\Repository\DefaultRepository;
use App\Service\FormFilter\AbstractFormFilter;
use App\Service\Report\Filter\FilterBuilder;

abstract class AbstractReport
{
    protected QueryBuilder $queryBuilder;

    protected ReportConfig $reportConfig;

    private DefaultRepository $defaultRepository;

    public function __construct(array $configParams = [])
    {
        $this->queryBuilder = new QueryBuilder();
        $this->defaultRepository = new DefaultRepository();
        $this->reportConfig = $this->createFromParams($configParams);
    }

    abstract public function getTitle(): string;

    abstract protected function init(): self;

    abstract protected function join(): self;

    abstract protected function group(): self;

    abstract public function getColumnsMap(): array;

    public function fetchData(): array|false
    {
        return $this->build()
            ->defaultRepository
            ->query($this->queryBuilder->build());
    }

    /**
     * @return ReportConfig
     */
    public function getConfig(): ReportConfig
    {
        return $this->reportConfig;
    }

    /**
     * @param array $params
     *
     * @return ReportConfig
     */
    protected function createFromParams(array $params = []): ReportConfig
    {
        return new ReportConfig();
    }

    protected function build(): self
    {
        return $this->init()
            ->join()
            ->filter()
            ->group()
            ->sort();
    }

    protected function filter(): self
    {
        if (empty($this->getConfig()->getFilters())) {
            return $this;
        }
        $filterBuilder = new FilterBuilder();
        $filterBuilder->addFromFormFilters(...$this->getConfig()->getFilters());
        $filtersByType = $filterBuilder->build();
        $this->queryBuilder->andWhere($filtersByType[AbstractFormFilter::WHERE]);
        $this->queryBuilder->andHaving($filtersByType[AbstractFormFilter::HAVING]);

        return $this;
    }

    protected function sort(): self
    {
        if (empty($this->getConfig()->getSort())) {
            return $this;
        }
        $this->queryBuilder->addOrder($this->getConfig()->getSort());

        return $this;
    }
}