<?php

declare(strict_types=1);

namespace App\Utils;

readonly class PaginationData
{
    public int $totalPages;
    public int $previousPage;
    public int $nextPage;
    public bool $hasPreviousPage;
    public bool $hasNextPage;

    public function __construct(int $entriesPerPage, int $totalEntries, int $currentPage)
    {
        $this->totalPages = (int)ceil($totalEntries / $entriesPerPage);
        $this->hasPreviousPage = $currentPage !== 1;
        $this->hasNextPage = $currentPage < $this->totalPages;
        $this->previousPage = $currentPage - 1;
        $this->nextPage = $currentPage + 1;
    }
}
