<?php

namespace App\Http\Livewire\FixedAsset;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\FixedAsset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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
        $this->orderable         = (new FixedAsset())->orderable;
    }

    public function render()
    {
        $query = FixedAsset::with(['branches'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $fixedAssets = $query->paginate($this->perPage);

        return view('livewire.fixed-asset.index', compact('fixedAssets', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('fixed_asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        FixedAsset::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(FixedAsset $fixedAsset)
    {
        abort_if(Gate::denies('fixed_asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fixedAsset->delete();
    }
}
