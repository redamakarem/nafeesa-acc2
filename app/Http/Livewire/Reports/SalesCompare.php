<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SalesCompare extends Component
{
    public $range1;
    public $range2;
    public $range1_array;
    public $range2_array;
    public $range1_query_res;
    public $range2_query_res;

    private function range_to_array($range_string)
    {
        return explode('to',str_replace(' ', '', $range_string));
    }

    private function get_graph_data($range_array)
    {
        return DB::table('sales')
            ->select('title_en', DB::raw('SUM(selling_price) as total_sales'), DB::raw('SUM(costs) as total_costs'), DB::raw('SUM(profit) as total_profit'))
            ->groupBy('branch_id')
            ->join('branches', 'branch_id', '=', 'branches.id')
            ->whereBetween('date',$range_array)
            ->get();
    }

    public function do_search()
    {
        
        $this->range1_query_res = $this->get_graph_data($this->range1_array);
        $this->range2_query_res = $this->get_graph_data($this->range2_array);
        $this->emit('refreshChart',['seriesData', [$this->range1_query_res, $this->range2_query_res]]);
    }

    public function updatedRange1($value)
    {
        if($value !=''){
            $this->range1_array = $this->range_to_array($value);
        }
    }
    public function updatedRange2($value)
    {
        if($value !=''){
            $this->range2_array = $this->range_to_array($value);
        }
    }

    public function render()
    {
        return view('livewire.reports.sales-compare');
    }
}
