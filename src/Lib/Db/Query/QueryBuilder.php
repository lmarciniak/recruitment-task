<?php

declare(strict_types=1);

namespace App\Lib\Db\Query;

class QueryBuilder
{
    private string $from = '';
    private string $select = '';

    /**
     * @var array<int, Join>
     */
    private array $join = [];
    private string $where = '';
    private string $having = '';
    private array $group = [];
    private array $order = [];

    public function build(): string
    {
        return sprintf('SELECT %s FROM %s ', $this->select, $this->from) .
            (empty($this->join) ? '' : implode(' ', $this->join)) .
            (empty($this->where) ? '' : " WHERE {$this->where}") .
            (empty($this->group) ? '' : (' GROUP BY ' . implode(', ', $this->group))) .
            (empty($this->having) ? '' : (" HAVING {$this->having}")) .
            (empty($this->order) ? '' : (' ORDER BY ' . implode(', ', $this->order)));
    }

    public function from(string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function select(string $select): self
    {
        $this->select = $select;

        return $this;
    }

    public function addJoin(Join $join): self
    {
        $this->join[] = $join;

        return $this;
    }

    public function addGroup(string $group): self
    {
        $this->group[] = $group;

        return $this;
    }

    public function addOrder(string $order): self
    {
        $this->order[] = $order;

        return $this;
    }

    public function andWhere(string $where): self
    {
        if (empty($where)) {
            return $this;
        }
        if (empty($this->where)) {
            $this->where = $where;
        } else {
            $this->where = "{$this->where} AND {$where}";
        }

        return $this;
    }

    public function andHaving(string $having): self
    {
        if (empty($having)) {
            return $this;
        }
        if (empty($this->having)) {
            $this->having = $having;
        } else {
            $this->having = "{$this->having} AND {$having}";
        }

        return $this;
    }
}
