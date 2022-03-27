<?php

namespace App\Http\Livewire\Finished;

use Livewire\Component;

class Show extends Component
{

    public $finished;


    public function mount($finished)
    {
        $this->finished = $finished;
    }
    public function render()
    {
        return view('livewire.finished.show');
    }
}
