<?php

declare(strict_types=1);

namespace Domain\Repository;

class PaginationQuery
{
    public const MAX_PER_PAGE = 50;

    /**
     * Undocumented function
     *
     * @param integer $page starting with `0`
     * @param integer $limit
     */
    public function __construct(
        private readonly int $page,
        private readonly int $limit = self::MAX_PER_PAGE)
    {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return max(0, $this->page - 1) * $this->limit;
    }
}
