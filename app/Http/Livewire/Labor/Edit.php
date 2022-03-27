<?php

namespace App\Http\Livewire\Labor;

use App\Models\Labor;
use Livewire\Component;

class Edit extends Component
{
    public Labor $labor;

    public function mount(Labor $labor)
    {
        $this->labor = $labor;
    }

    public function render()
    {
        return view('livewire.labor.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->labor->save();

        return redirect()->route('admin.labors.index');
    }

    protected function rules(): array
    {
        return [
            'labor.title_en' => [
                'string',
                'required',
            ],
            'labor.title_ar' => [
                'string',
                'required',
            ],

            'labor.basic_salary' => [
                'numeric',
                'required',
            ],
            'labor.allowance' => [
                'numeric',
                'nullable',
            ],
            'labor.indemnity_expenses' => [
                'numeric',
                'required',
            ],
            'labor.leave_expenses' => [
                'numeric',
                'required',
            ],
            'labor.flat_rent' => [
                'numeric',
                'required',
            ],
            'labor.medical_insurance' => [
                'numeric',
                'required',
            ],
            'labor.visa_residency' => [
                'numeric',
                'required',
            ],
            'labor.workers_insurance' => [
                'numeric',
                'required',
            ],
            'labor.uniform_expenses' => [
                'numeric',
                'required',
            ],'labor.travel_expenses' => [
                'numeric',
                'required',
            ],
        ];
    }
}
