<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class SalesByBranch extends Component
{
    public $sales_by_branch;

    public function mount($sales_by_branch)
    {
        $this->sales_by_branch = $sales_by_branch;
    }

    public function render()
    {
        return view('livewire.reports.sales-by-branch');
    }
}
