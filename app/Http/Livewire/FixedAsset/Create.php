<?php

namespace App\Http\Livewire\FixedAsset;

use App\Models\Branch;
use App\Models\FixedAsset;
use Livewire\Component;

class Create extends Component
{
    public array $branches = [];

    public FixedAsset $fixedAsset;

    public array $listsForFields = [];

    public function mount(FixedAsset $fixedAsset)
    {
        $this->fixedAsset = $fixedAsset;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.fixed-asset.create');
    }

    public function submit()
    {
        $this->validate();

        $this->fixedAsset->save();
//        $this->fixedAsset->branches()->sync($this->branches);

        return redirect()->route('admin.fixed-assets.index');
    }

    protected function rules(): array
    {
        return [
            'fixedAsset.title_en' => [
                'string',
                'required',
            ],
            'fixedAsset.title_ar' => [
                'string',
                'required',
            ],

        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['branches'] = Branch::pluck('title_en', 'id')->toArray();
    }
}
