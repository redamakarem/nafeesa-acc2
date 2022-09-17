<?php

namespace App\Http\Livewire\Sale;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Branch;
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
    public array $finished_filters = [];
    public array $branch_filters = [];
    public array $listsForFields = [];


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
        $this->query=null;

        $this->format = 'xlsx';
        $starting = Carbon::now()->subMonths(5)->toDateString();
        $ending = Carbon::now()->toDateString();
        $this->start_date = $starting;
        $this->end_date = $ending;
        $this->initListsForFields();
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

    protected function initListsForFields(): void
    {
        
        $this->listsForFields['finished'] = Finished::pluck('name_ar', 'id')->toArray();
        $this->listsForFields['branch_filters'] = Branch::pluck('title_en', 'id')->toArray();

    }
    
    public function render()
    {
        $da = [];
        if($this->selected_dates !=''){
            $string = str_replace(' ', '', $this->selected_dates);
        $this->dates_array = explode(',',$string);
        $da = $this->dates_array;
        }

        $query = Finished::query()

        ->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);
        if (count($this->finished_filters)>0){

            $query->whereIn('id',$this->finished_filters);
        }
       

    $this->query = $query;
    $sales = $query->paginate($this->perPage);
    // dd($sales);
        return view('livewire.sale.by-date',compact('query', 'sales','da'));
    }
}
