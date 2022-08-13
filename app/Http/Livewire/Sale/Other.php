<?php

namespace App\Http\Livewire\Sale;

use App\Models\Sales;
use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use Livewire\WithPagination;
use Livewire\Component;

class Other extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];


    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 10;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Sales())->orderable;
    }

    public function render()
    {
        $query = Sales::with(['item', 'branch','type'])->isNotSales()->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);
        $others = $query->paginate($this->perPage);
        return view('livewire.sale.other',compact('query', 'others'));
    }
}
