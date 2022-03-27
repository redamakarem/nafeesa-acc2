<?php

namespace App\Http\Livewire\SemiFinished;

use App\Models\Labor;
use App\Models\RawMaterial;
use App\Models\SemiFinished;
use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
    public $rms;
    public array $raw_materials = [];
    public $lbs;
    public array $labors = [];

    public $sfs;
    public $semi_finished;

    public array $listsForFields = [];

    public SemiFinished $semiFinished;

    public function mount(SemiFinished $semiFinished)
    {
        $semiFinished->load(['rawMaterials','semiFinished','rawMaterials.unit','labor']);
        $this->semiFinished  = $semiFinished;
        $this->rms= RawMaterial::orderBy('id','ASC')->get()->map(function($rm) use ($semiFinished) {
            $rm->value = data_get($semiFinished->rawMaterials->firstWhere('id', $rm->id), 'pivot.amount') ?? null;
            if($rm->value!==null){
                $this->raw_materials[$rm->id] =$rm->value;
            }
            return $rm;
        });

        $this->lbs= Labor::orderBy('id','ASC')->get()->map(function($lb) use ($semiFinished) {
            $lb->value = data_get($semiFinished->labor->firstWhere('id', $lb->id), 'pivot.workers') ?? null;
            $lb->labor_time = data_get($semiFinished->labor->firstWhere('id', $lb->id), 'pivot.labor_time') ?? null;
            if($lb->value!==null){
                $this->labors[$lb->id]['workers'] =$lb->value;
            }
            if($lb->labor_time!==null){
                $this->labors[$lb->id]['labor_time'] =$lb->labor_time;
            }
            return $lb;
        });
        $this->sfs= SemiFinished::where('id','!=',$this->semiFinished->id)->orderBy('id','ASC')->get()->map(function($sf) use ($semiFinished) {
            $sf->semi = data_get($semiFinished->semiFinished->firstWhere('id', $sf->id), 'pivot.amount') ?? null;
//            $sf->labor_time = data_get($semiFinished->labor->firstWhere('id', $sf->id), 'pivot.labor_time') ?? null;
            if($sf->semi!==null){
                $this->semi_finished[$sf->id] =$sf->semi;
            }
//            if($sf->labor_time!==null){
//                $this->labors[$sf->id]['labor_time'] =$sf->labor_time;
//            }
            return $sf;
        });



        $this->initListsForFields();
    }

    public function render()
    {

        return view('livewire.semi-finished.edit');
    }

    public function submit()
    {
//        $this->clean_raw_materials();
//        dd($this->mapRawMaterials($this->raw_materials), $this->raw_materials);
        $this->validate();
//        $this->semiFinished->inputs_per_kg = $this->semiFinished->rawMaterials->sum('pivot.amount');
//        $this->semiFinished->outputs_per_kg = $this->semiFinished->kilos_per_dough;
//        $this->semiFinished->production_loss_percent = 1-($this->semiFinished->kilos_per_dough/ $this->semiFinished->inputs_per_kg);
        $this->semiFinished->save();
//        dd($this->mapRawMaterials($this->raw_materials));
        $this->semiFinished->rawMaterials()->sync($this->mapRawMaterials($this->raw_materials));
        $this->semiFinished->labor()->sync($this->labors);

        return redirect()->route('admin.semi-finisheds.index');
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
            'raw_materials' =>['sometimes'],
//            'raw_materials' => [
//                'required',
//                'array',
//            ],
            'raw_materials.*.id' => [
                'sometimes'
            ],
//            'raw_materials.*.id' => [
//                'integer',
//                'exists:raw_materials,id',
//            ],
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
    private function mapRawMaterials($rawMaterials)
    {
        $rawMaterials = array_filter($rawMaterials, function($a) { return ($a !== 0); });
        return collect($rawMaterials)->map(function ($i) {
            if ($i !=null && $i>0)
            return ['amount' => $i];
        });
    }

    private function mapLabors($labors)
    {
        return collect($labors)->map(function ($i) {
            if ($i !==null)
                return ['workers' => $i];
        });
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['raw_materials'] = RawMaterial::pluck('name_en', 'id')->toArray();
        $this->listsForFields['unit']          = Unit::pluck('name_en', 'id')->toArray();
    }
}
