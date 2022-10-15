<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TopProducts extends Component
{
    public $top_products;
    public $selected_dates;
    public $selected_dates_array =[];
    public $selected_count=5;
    public $selected_clause='quantity';
    public $result;
    public $clause_options;
    

    public function mount()
    {
        $this->top_products = $this->top_products($this->selected_clause,$this->selected_count);
        $this->selected_dates_array = [];
        // $this->clause_options=[];
        // $this->clause_options[]=['quantity' =>'quantity'];
        // $this->clause_options[]=['price' =>'price'];
        // $this->clause_options[]=['profit' =>'profit'];
        // dd($this->clause_options);
        $this->top_products($this->selected_clause,$this->selected_count);
    }

    public function render()
    {
        
        return view('livewire.reports.top-products');
    }

    public function top_products($type = 'quantity', $count = 5)
    {
        if ($type == 'price') {
            $this->result = DB::table('sales')
                ->select('item_id', 'name_ar', DB::raw('sum(selling_price) as total'))
                ->join('finisheds', 'item_id', '=', 'finisheds.id')
                ->whereNotIn('item_id',[126,127,132,135,179,185,189,193])
                ->groupBy('item_id')
                ->orderBy('total', 'desc');
                // ->get()->take($this->selected_count);
        } elseif ($type == 'profit') {
            $this->result = DB::table('sales')
                ->select('item_id', 'name_ar', DB::raw('sum(profit) as total'))
                ->join('finisheds', 'item_id', '=', 'finisheds.id')
                ->whereNotIn('item_id',[126,127,132,135,179,185,189,193])
                ->groupBy('item_id')
                ->orderBy('total', 'desc');
                // ->get()->take($this->selected_count);
        } else {
            $this->result = DB::table('sales')
                ->select('item_id', 'name_ar', DB::raw('count(item_id) as total'))
                ->join('finisheds', 'item_id', '=', 'finisheds.id')
                ->whereNotIn('item_id',[126,127,132,135,179,185,189,193])
                ->groupBy('item_id')
                ->orderBy('total', 'desc');
                // ->get()->take($this->selected_count);
        }
        if (count($this->selected_dates_array)>1){
            $this->result = $this->result->whereIn('date',$this->selected_dates_array);
        }
        $this->result = $this->result
        
        ->get()->take($this->selected_count);
       
    }

    public function updatedSelectedClause($value)
    {
        // dd($this->result);
        $this->top_products($this->selected_clause,$this->selected_count);
        $this->emit('refreshChart',['seriesData', $this->result]);
    }
    public function updatedSelectedDates($value)
    {
        $this->selected_dates_array = explode(',',str_replace(' ', '', $this->selected_dates));
        $this->top_products($this->selected_clause,$this->selected_count);
        $this->emit('refreshChart',['seriesData', $this->result]);
    }

    public function updatedSelectedCount($value)
    {
        $this->top_products($this->selected_clause,$this->selected_count);
        $this->emit('refreshChart',['seriesData', $this->result]);
    }
    
}
