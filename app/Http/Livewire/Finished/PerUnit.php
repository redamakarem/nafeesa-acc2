<?php

namespace App\Http\Livewire\Finished;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Finished;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class PerUnit extends Component
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
        $this->orderable         = (new Finished())->orderable;
    }

    public function render()
    {
        $query = Finished::with(['rawMaterials', 'semiFinished', 'labor'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $finisheds = $query->paginate($this->perPage);

        return view('livewire.finished.per-unit', compact('finisheds', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('finished_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Finished::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Finished $finished)
    {
        abort_if(Gate::denies('finished_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finished->delete();
    }
}
