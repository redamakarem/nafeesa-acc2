<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class TopProducts extends Component
{
    public $top_products;

    public function mount($top_products)
    {
        $this->top_products = $top_products;
    }

    public function render()
    {
        return view('livewire.reports.top-products');
    }
}
