<?php

namespace App\Http\Livewire\LoyaltyItem;

use App\Models\Finished;
use App\Models\LoyaltyItem;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    public function mount(LoyaltyItem $loyaltyItem)
    {
        $this->loyaltyItem = $loyaltyItem;
        $this->initListsForFields();
    }

    protected function rules(): array
    {
        return [
            'loyaltyItem.item_id' => [
                'required',
            ],
            
        ];
    }

    public function submit()
    {
        $this->validate();

        $this->loyaltyItem->save();

        return redirect()->route('admin.loyalty-items.index');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['finished_items'] = Finished::pluck('item_code', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.loyalty-item.create');
    }
}
