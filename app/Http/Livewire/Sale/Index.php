<?php

namespace App\Http\Livewire\Sale;

use App\Exports\SalesExport;
use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Branch;
use App\Models\Finished;
use App\Models\Sales;
use App\Models\Weekday;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;

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


    public $start_date ;
    public $end_date ;
    public $from_id;
    public $to_id;
    public array $listsForFields = [];
    public array $branch_filters = [];
    public array $weekday_filters = [];
    public array $finished_filters = [];


    public $total_sales;
    public $total_costs;

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


        $now = Carbon::now()->toDateString();
        $this->start_date = $now;
        $this->end_date = $now;
        $this->from_id = 0;
        $this->to_id = 9999999;
        $this->total_sales = 0;
        $this->total_costs = 0;
        $this->total_profit = 0;

        $this->query=null;

        $this->format = 'xlsx';


        $this->initListsForFields();
    }

    public function render()
    {
        $query = Sales::with(['item', 'branch'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);
//
//
//
//        $sales = $query->paginate($this->perPage);

//        return view('livewire.sale.index', compact('query', 'sales'));

//        $query = Sales::query();
        $query = $query->whereBetween('date',[$this->start_date,$this->end_date]);
        $query = $query->when($this->from_id,function ($q){
            return $q->whereHas('item',function ($qq){
               return $qq->where('item_code','>=',$this->from_id);
            });
//           return $q->where('item_id','>=',$this->from_id);
        });
        $query = $query->when($this->to_id,function ($q){
            return $q->whereHas('item',function ($qq){
                return $qq->where('item_code','<',$this->to_id);
            });
            //           return $q->where('item_id','<',$this->to_id);
        });
//        $query = $query->whereHas('item',function ($q){
//           return $q->whereBetween('item_code',[$this->from_id,$this->to_id]);
//        });
        if (count($this->branch_filters)>0){

            $query->whereIn('branch_id',$this->branch_filters);
        }
        if (count($this->weekday_filters)>0){

            $query->whereIn('weekday',$this->weekday_filters);
        }
        if (count($this->finished_filters)>0){

            $query->whereIn('item_id',$this->finished_filters);
        }
        $this->total_sales = $query->sum('selling_price');
        $this->total_costs = $query->sum('costs');
        $this->total_profit = $this->total_sales - $this->total_costs;
        $sales = $query->paginate($this->perPage);
        $this->query = $query;

        return view('livewire.sale.index', compact('query', 'sales'));
    }

    public function export()
    {
        return (new SalesExport($this->start_date,$this->end_date,$this->branch_filters,$this->finished_filters,$this->weekday_filters))->download('sales.xlsx');
    }

    public function validateExportType()
    {
        $formats = config('excel.extension_detector');

        abort_if(in_array($this->format, $formats), Response::HTTP_NOT_FOUND);

        return $formats[$this->format];
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('sale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Sales::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Sales $sale)
    {
        abort_if(Gate::denies('sale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sale->delete();
    }


    protected function initListsForFields(): void
    {
        $this->listsForFields['branch_filters'] = Branch::pluck('title_en', 'id')->toArray();
        $this->listsForFields['weekdays'] = Weekday::pluck('name', 'code')->toArray();
        $this->listsForFields['finished'] = Finished::pluck('item_code', 'id')->toArray();

    }
}
