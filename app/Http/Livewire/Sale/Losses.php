<?php

namespace App\Http\Livewire\Sale;

use App\Models\Sales;
use Livewire\Component;
use App\Exports\SalesExport;
use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use Livewire\WithPagination;

class Losses extends Component
{

    // ***********************************************************

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
        $query = Sales::with(['item', 'branch'])->where('profit','<',0)->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);



        $sales = $query->paginate($this->perPage);

        return view('livewire.sale.losses', compact('query', 'sales'));



        return view('livewire.sale.index', compact('query', 'sales'));
    }

    // public function export()
    // {
    //     return (new SalesExport($this->start_date,$this->end_date,$this->branch_filters,$this->finished_filters,$this->weekday_filters))->download('sales.xlsx');
    // }

    public function validateExportType()
    {
        $formats = config('excel.extension_detector');

        abort_if(in_array($this->format, $formats), Response::HTTP_NOT_FOUND);

        return $formats[$this->format];
    }


}
