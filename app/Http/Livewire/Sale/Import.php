<?php

namespace App\Http\Livewire\Sale;

use App\Imports\RawMaterialImport;
use App\Imports\SalesImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;


    public $file;

    private $file_path;
    public function render()
    {
        return view('livewire.sale.import');
    }

    protected function rules()
    {
        return [
            'file' =>'required'
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->file_path = $this->file->store('imports');
        Excel::import(new SalesImport(),$this->file_path);
    }
}
