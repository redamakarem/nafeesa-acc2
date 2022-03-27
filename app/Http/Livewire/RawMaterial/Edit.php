<?php

namespace App\Http\Livewire\RawMaterial;

use App\Models\RawMaterial;
use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
    public RawMaterial $rawMaterial;

    public array $listsForFields = [];

    public function mount(RawMaterial $rawMaterial)
    {
        $this->rawMaterial = $rawMaterial;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.raw-material.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->rawMaterial->save();

        return redirect()->route('admin.raw-materials.index');
    }

    protected function rules(): array
    {
        return [
            'rawMaterial.name_en' => [
                'string',
                'required',
            ],
            'rawMaterial.name_ar' => [
                'string',
                'required',
            ],
            'rawMaterial.code' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],

            'rawMaterial.avg_cost' => [
                'numeric',
                'required',
            ],
            'rawMaterial.unit_id' => [
                'integer',
                'exists:units,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['unit'] = Unit::pluck('name_en', 'id')->toArray();
    }
}
