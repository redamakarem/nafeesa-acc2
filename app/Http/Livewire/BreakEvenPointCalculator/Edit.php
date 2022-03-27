<?php

namespace App\Http\Livewire\BreakEvenPointCalculator;

use App\Models\Branch;
use App\Models\BranchFixedAsset;
use App\Models\FixedAsset;
use Livewire\Component;

class Edit extends Component
{

    public $branches;
    public $fixedAssets;

    public array $assets = [];
    public array $branches_array = [];
    public $branch_fixedAssets = [];
    public $branch_count;
    public $asset_count;
    public function mount()
    {
        $this->branches = Branch::all();
        $this->fixedAssets = FixedAsset::all();
        $this->branch_count = $this->branches->count();
        $this->asset_count = $this->fixedAssets->count();
//
        foreach (BranchFixedAsset::all() as $bfa)
        {
            $branch_id = intval($bfa->branch_id);
            $fixed_asset_id = intval($bfa->fixed_asset_id);

            $this->branch_fixedAssets[$fixed_asset_id][$branch_id] = $bfa->amount;
        }
//        dd($this->branch_fixedAssets);
    }

    public function mapAssets($assets)
    {
        return collect($assets)->map(function ($i) {
            return ['amount' => $i];
        });
    }
    private function mapBranches($branches)
    {

        return collect($branches)->map(function ($i) {
            return ['id' => $i];
        });
    }

    public function submit()
    {
        foreach ($this->branch_fixedAssets as $assetKey =>$assetValue)
        {
            $assetModel = FixedAsset::find($assetKey);
            $assetModel->branches()->sync($this->mapAssets($assetValue));
        }
        $this->redirect(route('admin.bepc.show'));
    }

    public function render()
    {
        return view('livewire.break-even-point-calculator.edit');
    }
}
