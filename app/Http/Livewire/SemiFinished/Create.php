<?php

namespace App\Http\Livewire\SemiFinished;

use App\Models\Labor;
use App\Models\RawMaterial;
use App\Models\SemiFinished;
use App\Models\Unit;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{

    public  array $selected_raw_materials;
    public  array $selected_semiFinished;
    public  array $selected_labor;

    public $rms;

    public array $raw_materials = [];

    public $lbs;

    public array $labours = [];

    public $sfs;
    public array $semi_finished = [];

    public array $listsForFields = [];

    public SemiFinished $semiFinished;

    public function mount(SemiFinished $semiFinished)
    {
        $this->selected_raw_materials = [];
        $this->selected_semiFinished = [];
        $this->selected_labor = [];
        $this->semiFinished = $semiFinished;
        $this->semiFinished->transport = 0;
        $this->semiFinished->other = 0;
        $this->rms = RawMaterial::with(['unit'])->orderBy('id','ASC')->get();
        $this->lbs = Labor::all();
        $this->sfs=SemiFinished::with(['unit','rawMaterials','rawMaterials.unit','semiFinished','semiFinished.unit','labor'])->orderBy('id','ASC')->get();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.semi-finished.create');
    }

    public function submit()
    {
        $this->validate();

        $this->semiFinished->save();
        $this->semiFinished->rawMaterials()->sync($this->mapRawMaterials($this->raw_materials));
        $this->semiFinished->semiFinished()->sync($this->mapSemiFinished($this->semi_finished));
        $this->semiFinished->labor()->sync($this->labours);
//        $this->semiFinished->labor()->sync($this->mapRawLabor($this->labours));

        return redirect()->route('admin.semi-finisheds.index');
    }

    private function mapRawMaterials($rawMaterials)
    {
        return collect($rawMaterials)->map(function ($i) {
            return ['amount' => $i];
        });
    }

    private function mapSemiFinished($semiFinished)
    {
        return collect($semiFinished)->map(function ($i) {
            return ['amount' => $i];
        });
    }

    private function mapRawLabor($labor)
    {
        return collect($labor)->map(function ($i) {
            return ['workers' => $i];
        });
    }

    protected function rules(): array
    {
        return [
            'semiFinished.item_code' => [
                'numeric',
                'required',
            ],
            'semiFinished.name_en' => [
                'string',
                'required',
            ],
            'semiFinished.name_ar' => [
                'string',
                'required',
            ],
            'raw_materials' => [
                'array',
            ],
            'raw_materials.*.id' => [
                'integer',
                'exists:raw_materials,id',
            ],
            'semiFinished.kilos_per_dough' => [
                'numeric',
                'required',
            ],
            'semiFinished.unit_id' => [
                'integer',
                'exists:units,id',
                'required',
            ],
            'semiFinished.transport' => [
                'numeric',
            ],

            'semiFinished.other' => [
                'numeric',
            ],

            'semiFinished.notes' => [
                'sometimes',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['raw_materials'] = RawMaterial::pluck('name_en', 'id')->toArray();
        $this->listsForFields['unit']          = Unit::pluck('name_en', 'id')->toArray();

    }

    public function key_is_in_array($key, $array)
    {
        if (key_exists($key,$array)){
            return $array[$key];
        }
        else{
            return false;
        }
    }
}
