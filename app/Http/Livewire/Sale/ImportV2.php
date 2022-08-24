<?php

namespace App\Http\Livewire\Sale;

use App\Imports\SalesImportV2;
use App\Models\Branch;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportV2 extends Component
{
    use WithFileUploads;

    public $selected_date = '';
    public $selected_branch = null;
    public $branches;
    public $file = null;
    private $file_path;

    public function mount()
    {
        $this->branches = Branch::pluck('title_en', 'id')->toArray();
    }
    protected function rules()
    {
        return [
            'selected_date' =>['required'],
            'selected_branch' =>['required'],
            'file' =>['required'],
        ];
    }
    public function submit()
    {
        // dd($this->selected_branch, $this->selected_date);
        $this->validate();
        $this->file_path = $this->file->store('imports');
        Excel::import(new SalesImportV2($this->selected_date, $this->selected_branch),$this->file_path);
        $this->reset(['selected_date','selected_branch','file']);
    }


    public function render()
    {
        return view('livewire.sale.import-v2');
    }
}
