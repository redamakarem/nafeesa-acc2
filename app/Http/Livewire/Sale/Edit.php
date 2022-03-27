<?php

namespace App\Http\Livewire\Sale;

use App\Models\Branch;
use App\Models\Finished;
use App\Models\Sales;
use Livewire\Component;

class Edit extends Component
{
    public Sales $sale;

    public array $listsForFields = [];

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.sale.edit');
    }

    public function submit()
    {
        $this->validate();

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
            'sale.date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'sale.branch_id' => [
                'integer',
                'exists:branches,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['item']   = Finished::pluck('name_en', 'id')->toArray();
        $this->listsForFields['branch'] = Branch::pluck('title_en', 'id')->toArray();
    }
}
