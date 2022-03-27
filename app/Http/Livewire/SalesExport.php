<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
class SalesExport extends Component
{

    public $q;

    public function mount($q)
    {
        $this->q = $q;
    }
    public function render()
    {
        return view('livewire.sales-export');
    }

    public function export()
    {
        return Excel::download(new \App\Exports\SalesExport($q));
    }
}
