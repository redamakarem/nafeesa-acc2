<?php

namespace App\Http\Livewire;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Branch;
use App\Models\Finished;
use App\Models\Sales;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;


use Livewire\Component;

class LossItems extends Component
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
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Finished())->orderable;
    }

    public function render()
    {
        $query = Sales::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $item_ids = $query->with(['item', 'branch'])->isSales()->where('profit','<',0)->distinct('item_id')->pluck('item_id');

        $items = Finished::whereIn('id',$item_ids)->paginate($this->perPage);

        return view('livewire.loss-items', compact('items', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('branch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Branch::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Branch $branch)
    {
        abort_if(Gate::denies('branch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branch->delete();
    }

    
}
