<?php

namespace App\Http\Livewire\Sale;

use App\Models\Sales;
use Livewire\Component;
use App\Exports\SalesExport;
use Livewire\WithPagination;
use Illuminate\Http\Response;
use App\Http\Livewire\WithSorting;
use App\Http\Livewire\WithConfirmation;
use Illuminate\Support\Facades\DB;

class ByProduct extends Component
{


    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;




    private $query;

    public $format;


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
        $this->query=null;

        $this->format = 'xlsx';
    }
    public function render()
    {
        $query = Sales::with(['item', 'branch'])->isSales()->groupBy('item_id')
        ->selectRaw('count(*) as total, SUM(costs) as costs,SUM(profit) as profits, item_id')->orderBy('total','DESC');
        //     ->advancedFilter([
        //     's'               => $this->search ?: null,
        //     'order_column'    => $this->sortBy,
        //     'order_direction' => $this->sortDirection,
        // ]);
        $sales = $query->paginate($this->perPage);
        return view('livewire.sale.by-product', compact('query', 'sales'));

    }

    public function validateExportType()
    {
        $formats = config('excel.extension_detector');

        abort_if(in_array($this->format, $formats), Response::HTTP_NOT_FOUND);

        return $formats[$this->format];
    }



    
}
