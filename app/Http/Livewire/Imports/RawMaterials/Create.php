<?php

namespace App\Http\Livewire\Imports\RawMaterials;

use App\Imports\RawMaterialImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;

    public $file;

    private $file_path;

    public function render()
    {
        return view('livewire.imports.raw-materials.create');
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
//        dd($this->file_path);
        Excel::import(new RawMaterialImport(),$this->file_path);
    }
}
