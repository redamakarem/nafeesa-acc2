<?php

namespace App\Http\Livewire\Sale;

use App\Models\Branch;
use App\Models\Finished;
use App\Models\Sales;
use App\Models\TransactionType;
use Livewire\Component;

class Edit extends Component
{
    public Sales $sale;

    public array $listsForFields = [];

    public function mount(Sales $sale)
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
            'sale.transaction_type' => [
                'integer',
                'exists:transaction_types,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['item']   = Finished::pluck('name_en', 'id')->toArray();
        $this->listsForFields['branch'] = Branch::pluck('title_en', 'id')->toArray();
        $this->listsForFields['transaction_type'] = TransactionType::pluck('name_en', 'id')->toArray();
    }
}
