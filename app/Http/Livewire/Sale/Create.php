<?php

namespace App\Http\Livewire\Sale;

use App\Models\Branch;
use App\Models\Finished;
use App\Models\Sales;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    public Sales $sale;

    public array $listsForFields = [];

    public function mount(Sales $sale)
    {
        $this->sale      = $sale;
        $this->sale->qty = '0';
        $this->sale->profit = 0;

        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.sale.create');
    }

    public function submit()
    {
        $this->validate();
        $this->sale->weekday = Carbon::parse($this->sale->date)->dayOfWeek;

        $this->sale->save();

        return redirect()->route('admin.sales.index');
    }

    protected function rules(): array
    {
        return [
            'sale.item_id' => [
                'integer',
                'exists:finisheds,id',
                'required',
            ],
            'sale.qty' => [
                'numeric',
                'required',
            ],
            'sale.selling_price' => [
                'numeric',
                'required',
            ],
            'sale.date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'sale.branch_id' => [
                'integer',
                'exists:branches,id',
                'required',
            ],
            'sale.profit' => [
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['item']   = Finished::pluck('item_code', 'id')->toArray();
        $this->listsForFields['branch'] = Branch::pluck('title_en', 'id')->toArray();
    }
}
