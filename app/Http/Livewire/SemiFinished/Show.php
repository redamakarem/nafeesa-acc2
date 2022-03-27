<?php

namespace App\Http\Livewire\SemiFinished;

use Livewire\Component;

class Show extends Component
{

    public $semiFinished;


    public function mount($semiFinished)
    {
        $this->semiFinished = $semiFinished;
    }
    public function render()
    {
        return view('livewire.semi-finished.show');
    }


}
