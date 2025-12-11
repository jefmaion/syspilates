<?php

declare(strict_types = 1);

namespace App\Traits;

use Livewire\WithPagination;

trait PaginationTrait
{
    use WithPagination;

    public string $search = '';

    public int $pages = 10;
}
