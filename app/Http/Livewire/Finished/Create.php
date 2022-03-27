<?php

namespace App\Http\Livewire\Finished;

use App\Models\Finished;
use App\Models\Labor;
use App\Models\RawMaterial;
use App\Models\SemiFinished;
use App\Models\Unit;
use Livewire\Component;
use Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia;

class Create extends Component
{
    use WithMedia;

    public  array $selected_raw_materials;
    public  array $selected_semiFinished;
    public  array $selected_labor;
    public $rms;
    public $lbs;
    public $sfs;

    public array $labours = [];

    public Finished $finished;

    public array $raw_materials = [];

    public array $semi_finished = [];

    public array $listsForFields = [];
    public $mediaComponentNames = ['item_image'];
    public $item_image;

    public function mount(Finished $finished)
    {
        $this->selected_raw_materials = [];
        $this->selected_semiFinished = [];
        $this->selected_labor = [];
        $this->finished = $finished;
        $this->rms = RawMaterial::all();
        $this->lbs = Labor::all();
        $this->sfs=SemiFinished::all();
        $this->initListsForFields();
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

    private function mapLabor($labor)
    {
        return collect($labor)->map(function ($i) {
            return ['workers' => $i];
        });
    }

    public function render()
    {
        return view('livewire.finished.create');
    }

    public function submit()
    {
        $this->validate();

        $this->finished->save();
        $this->finished->rawMaterials()->sync($this->mapRawMaterials($this->raw_materials));
        $this->finished->semiFinished()->sync($this->mapSemiFinished($this->semi_finished));
        $this->finished->labor()->sync($this->labours);
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
            'labours' => [
                'array',
            ],
            'labours.*.id' => [
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

    public function key_is_in_array($key, $array)
    {
        if (key_exists($key,$array)){
            return $array[$key];
        }
        else{
            return false;
        }
    }


    protected function initListsForFields(): void
    {
        $this->listsForFields['raw_materials'] = RawMaterial::pluck('name_en', 'id')->toArray();
        $this->listsForFields['semi_finished'] = SemiFinished::pluck('name_en', 'id')->toArray();
        $this->listsForFields['labor']         = Labor::pluck('title_en', 'id')->toArray();
        $this->listsForFields['unit']          = Unit::pluck('name_en', 'id')->toArray();
    }
}
