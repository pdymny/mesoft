<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;

class ShowDocuments extends Component
{
	public $xyztest;

    public function render()
    {
        return view('documents.show', ['xyztest' => $this->xyztest]);
    }
}
