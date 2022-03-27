<?php

namespace App\Http\Livewire\BreakEvenPointCalculator;

use App\Models\Branch;
use App\Models\FixedAsset;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Create extends Component
{

    public $branches;
    public $fixedAssets;

    public array $assets = [];
    public function mount()
    {
        $this->branches=Branch::all();
        $this->fixedAssets=FixedAsset::all();
    }

    private function mapAssets($assets)
    {
        return collect($assets)->map(function ($i) {
            return ['amount' => $i];
        });
    }

    public function submit()
    {
//        dd($this->assets);
        foreach ($this->assets as $assetKey =>$assetValue)
        {
            $assetModel = FixedAsset::find($assetKey);
            $assetModel->branches()->sync($this->mapAssets($assetValue));
        }
    }


    public function render()
    {
        return view('livewire.break-even-point-calculator.create');
    }
}
