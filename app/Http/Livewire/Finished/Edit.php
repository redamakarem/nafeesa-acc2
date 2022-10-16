<?php

namespace App\Http\Livewire\Finished;

use App\Models\Finished;
use App\Models\Labor;
use App\Models\RawMaterial;
use App\Models\SemiFinished;
use App\Models\Unit;
use Livewire\Component;
use Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia;

class Edit extends Component
{
    use WithMedia;

    public $lbs;
    public array $labor = [];

    public Finished $finished;

    public $rms;
    public array $raw_materials = [];

    public $sfs;

    public array $semi_finished = [];

    public array $listsForFields = [];

    public $mediaComponentNames = ['item_image'];
    public $item_image;

    public function mount(Finished $finished)
    {

        $finished->load(['rawMaterials','rawMaterials.unit','labor','semiFinished']);
        $this->rms= RawMaterial::get()->map(function($rm) use ($finished) {
            $rm->value = data_get($finished->rawMaterials->firstWhere('id', $rm->id), 'pivot.amount') ?? null;
            if($rm->value!==null){
                $this->raw_materials[$rm->id] =$rm->value;
            }
            return $rm;
        });

        $this->lbs= Labor::orderBy('id','ASC')->get()->map(function($lb) use ($finished) {
            $lb->value = data_get($finished->labor->firstWhere('id', $lb->id), 'pivot.workers') ?? null;
            $lb->labor_time = data_get($finished->labor->firstWhere('id', $lb->id), 'pivot.labor_time') ?? null;
            if($lb->value!==null){
                $this->labor[$lb->id]['workers'] =$lb->value;
            }
            if($lb->labor_time!==null){
                $this->labor[$lb->id]['labor_time'] =$lb->labor_time;
            }
            return $lb;
        });

        $this->sfs= SemiFinished::get()->map(function($sf) use ($finished) {
            $sf->value = data_get($finished->semiFinished->firstWhere('id', $sf->id), 'pivot.amount') ?? null;
            if($sf->value!==null){
                $this->semi_finished[$sf->id] =$sf->value;
            }
            return $sf;
        });

        $this->finished      = $finished;


//        $this->raw_materials = $this->finished->rawMaterials()->pluck('id')->toArray();
//        $this->semi_finished = $this->finished->semiFinished()->pluck('id')->toArray();
//        $this->labor         = $this->finished->labor()->pluck('id')->toArray();
        $this->initListsForFields();
    }



    private function mapRawMaterials($rawMaterials)
    {
        $rawMaterials = array_filter($rawMaterials, function($a) { return ($a !== 0); });
        $rawMaterials = array_filter($rawMaterials);
        $result= collect($rawMaterials)->map(function ($i) {
            if ($i !=null && $i>0 && $i!='0' && $i !=''){
            return ['amount' => $i];
            }
        });

        return $result;
    }
    private function mapSemiFinished($semiFinished)
    {
        $semiFinished = array_filter($semiFinished, function($a) { return ($a !== 0); });
        $semiFinished = array_filter($semiFinished);
        $result= collect($semiFinished)->map(function ($i) {
            if ($i !=null && $i>0 && $i!='0' && $i !=''){
            return ['amount' => $i];
            }
        });

        return $result;
    }

    private function mapLabor($labor)
    {
        return collect($labor)->map(function ($i) {
            if ($i !=null && $i>0 && $i!='0' && $i !=''){
            return ['workers' => $i];
            }
        });
    }

    public function render()
    {
        return view('livewire.finished.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->finished->save();
        $this->finished->rawMaterials()->sync($this->mapRawMaterials($this->raw_materials));
        $this->finished->semiFinished()->sync($this->mapSemiFinished($this->semi_finished));
        $this->finished->labor()->sync($this->labor);
        $this->finished->syncFromMediaLibraryRequest($this->item_image)
            ->toMediaCollection('finished_images');

        return redirect()->route('admin.finisheds.index');
    }

    protected function rules(): array
    {
        return [
            'finished.item_code' => [
                'numeric',
                'required',
            ],
            'finished.name_en' => [
                'string',
                'required',
            ],
            'finished.name_ar' => [
                'string',
                'required',
            ],

            'finished.kilos_per_dough' => [
                'numeric',
                'required',
            ],
            'raw_materials' => [
                'array',
            ],
            'raw_materials.*.id' => [
                'integer',
                'exists:raw_materials,id',
            ],
            'semi_finished' => [
                'array',
            ],
            'semi_finished.*.id' => [
                'integer',
                'exists:semi_finisheds,id',
            ],
            'labor' => [
                'array',
            ],
            'labor.*.id' => [
                'integer',
                'exists:labors,id',
            ],
            'finished.freight' => [
                'numeric',
            ],
            'finished.transport' => [
                'numeric',
            ],
            'finished.loyalty' => [
                'numeric',
            ],
            'finished.other' => [
                'numeric',
            ],
            'finished.sale_price' => [
                'numeric',
            ],
            'finished.notes' => [
                'sometimes',
            ],
            'finished.unit_id' => [
                'integer',
                'exists:units,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['raw_materials'] = RawMaterial::pluck('name_en', 'id')->toArray();
        $this->listsForFields['semi_finished'] = SemiFinished::pluck('name_en', 'id')->toArray();
        $this->listsForFields['labor']         = Labor::pluck('title_en', 'id')->toArray();
        $this->listsForFields['unit']          = Unit::pluck('name_en', 'id')->toArray();
    }
}
