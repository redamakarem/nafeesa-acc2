<?php

namespace App\Http\Livewire\Labor;

use App\Models\Labor;
use Livewire\Component;

class Show extends Component
{

    public Labor $labor;
    public function render()
    {
        return view('livewire.labor.show');
    }


    public function mount(Labor $labor)
    {
        $this->labor = $labor;
    }

}
