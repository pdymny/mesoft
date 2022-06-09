<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;

class ShowWidget extends Component
{
	use WithFileUploads;
	
    public function render()
    {
        return view('settings.show_widget');
    }
}
