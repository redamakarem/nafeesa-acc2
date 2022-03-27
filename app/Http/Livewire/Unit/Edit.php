<?php

namespace App\Http\Livewire\Unit;

use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
    public Unit $unit;

    public function mount(Unit $unit)
    {
        $this->unit = $unit;
    }

    public function render()
    {
        return view('livewire.unit.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->unit->save();

        return redirect()->route('admin.units.index');
    }

    protected function rules(): array
    {
        return [
            'unit.name_en' => [
                'string',
                'required',
            ],
            'unit.name_ar' => [
                'string',
                'required',
            ],
        ];
    }
}
