<?php

namespace App\Livewire;

use Livewire\Component;

class Form extends Component
{
    public $title = "Qwerty";

    public function render()
    {
        return view('livewire.form');
    }
}
