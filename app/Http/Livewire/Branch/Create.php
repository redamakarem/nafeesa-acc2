<?php

namespace App\Http\Livewire\Branch;

use App\Models\Branch;
use Livewire\Component;

class Create extends Component
{
    public Branch $branch;

    public function mount(Branch $branch)
    {
        $this->branch         = $branch;
        $this->branch->shifts = '1';
    }

    public function render()
    {
        return view('livewire.branch.create');
    }

    public function submit()
    {
        $this->validate();

        $this->branch->save();

        return redirect()->route('admin.branches.index');
    }

    protected function rules(): array
    {
        return [
            'branch.title_en' => [
                'string',
                'required',
            ],
            'branch.title_ar' => [
                'string',
                'required',
            ],
            'branch.shifts' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'branch.labor_count' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'branch.total_manhours' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
        ];
    }
}
