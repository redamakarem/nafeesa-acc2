<?php

namespace App\Http\Livewire\BreakEvenPointCalculator;

use App\Models\Branch;
use App\Models\FixedAsset;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Show extends Component
{
    public  $branches;
    public  $fixedAssets;

    public array $assets = [];
    public function mount()
    {
        $this->branches=Branch::all();
        $this->fixedAssets=FixedAsset::with('branches')->get();
    }






    public function render()
    {
        return view('livewire.break-even-point-calculator.show');
    }
}
