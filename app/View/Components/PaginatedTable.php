<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginatedTable extends Component
{
    public LengthAwarePaginator $items;
    public array $columns;
    public array $actions;

    public function __construct(LengthAwarePaginator $items, array $columns, array $actions = [])
    {
        $this->items = $items;
        $this->columns = $columns;
        $this->actions = $actions;
    }

    public function render(): View|Closure|string
    {
        return view('components.paginated-table');
    }
}


