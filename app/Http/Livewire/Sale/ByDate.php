<?php

namespace App\Http\Livewire\Sale;

use Carbon\Carbon;
use App\Models\Sales;
use Livewire\Component;
use App\Models\Finished;
use Livewire\WithPagination;
use Illuminate\Http\Response;
use App\Http\Livewire\WithSorting;
use App\Exports\SalesPerProductExport;
use App\Http\Livewire\WithConfirmation;

class ByDate extends Component
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
    public $selected_dates='';
    public $dates_array = [];



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

    

    public function export()
    {
        return (new SalesPerProductExport($this->start_date,$this->end_date))->download('sales-per-product.xlsx');
        return redirect(route('admin.reports.pps'));
    }


    public function validateExportType()
    {
        $formats = config('excel.extension_detector');

        abort_if(in_array($this->format, $formats), Response::HTTP_NOT_FOUND);

        return $formats[$this->format];
    }
    
    public function updatedSelectedDates($value)
    {
        $string = str_replace(' ', '', $value);
        $this->dates_array = explode(',',$string);
    }
    
    public function render()
    {
        $da = [];
        if($this->selected_dates !=''){
            $string = str_replace(' ', '', $this->selected_dates);
        $this->dates_array = explode(',',$string);
        $da = $this->dates_array;
        // dd($da);
        }
        $this->query = Finished::query()
        ->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

    $qq = $this->query;
    $sales = $qq->paginate($this->perPage);
        return view('livewire.sale.by-date',compact('qq', 'sales','da'));
    }
}
