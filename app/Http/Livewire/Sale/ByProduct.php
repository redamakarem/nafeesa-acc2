<?php

namespace App\Http\Livewire\Sale;

use Carbon\Carbon;
use App\Models\Sales;
use Livewire\Component;
use App\Exports\SalesExport;
use Livewire\WithPagination;
use Illuminate\Http\Response;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\WithConfirmation;

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

    public $start_date ;
    public $end_date ;


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
        $starting = Carbon::now()->subMonths(5)->toDateString();
        $ending = Carbon::now()->toDateString();
        $this->start_date = $starting;
        $this->end_date = $ending;
    }

    public function test()
    {
        dd($this->query->get());
    }

    public function render()
    {
        $this->query = Sales::with(['item', 'branch'])->isSales()->groupBy('item_id')
        ->select(DB::raw('count(*) as total, SUM(costs) as costs,SUM(profit) as profits, SUM(selling_price) as totalsales,item_id'))->orderBy('total','DESC');
        
        //     ->advancedFilter([
        //     's'               => $this->search ?: null,
        //     'order_column'    => $this->sortBy,
        //     'order_direction' => $this->sortDirection,
        // ]);
        $this->query = $this->query->whereBetween('date',[$this->start_date,$this->end_date]);
        $qq = $this->query;
        $sales = $this->query->paginate($this->perPage);
        dd($sales);
        return view('livewire.sale.by-product', compact('qq', 'sales'));

    }

    public function validateExportType()
    {
        $formats = config('excel.extension_detector');

        abort_if(in_array($this->format, $formats), Response::HTTP_NOT_FOUND);

        return $formats[$this->format];
    }



    
}
