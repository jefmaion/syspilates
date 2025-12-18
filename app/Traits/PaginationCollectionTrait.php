<?php

declare(strict_types = 1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationCollectionTrait
{
    protected $queryString = ['page'];

    public $page = 1;

    public function paginate($data, $pages = 10)
    {
        $perPage        = $pages;
        $currentPage    = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = Collection::make($data);

        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        return  new LengthAwarePaginator(
            $currentPageItems,
            count($itemCollection),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }
}
