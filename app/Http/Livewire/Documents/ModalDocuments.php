<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

use App\Models\Document;

use App\Notifications\NotifyUser;

class ModalDocuments extends Component
{
	use WithFileUploads;

	public $document;
	public $user;
	public $patient_id;
    public $sum_size;
    public $pack_size;

	public function mount()
	{
		$this->user = Auth::user();

        $this->sum_size = Document::where('team_id', '=', $this->user->currentTeam->id)->sum('size');
        $this->renderSize();
        $this->pack_size = $this->packingSize($this->user->currentTeam->id_pack);
	}

    public function render()
    {
        return view('documents.modal_document');
    }

    public function save()
    {
    	$path = 'files/'.$this->user->current_team_id.'/'.$this->patient_id;
        $d_path = $this->document->store($path);

    	$doc = new Document;
    	$doc->team_id = $this->user->current_team_id;
    	$doc->user_id = $this->user->id;
    	$doc->patient_id = $this->patient_id;
    	$doc->path = $d_path;
    	$doc->name = $this->document->getClientOriginalName();
    	$doc->size = $this->document->getSize();
    	$doc->save();

    	$this->document = "";

        $this->user->notify(new NotifyUser('Dokument o nazwie <i>'.$doc->name.'</i> został dodany.'));

        $this->dispatchBrowserEvent('close-modal', ['modal' => 'modalDoc']);
        $this->emit('ShowTableDocumentsRefresh');
    }

    public function packingSize($pack)
    {
        switch($pack) {
            case 0: $size = '100'; break;
            case 1: $size = '2048'; break;
            case 2: $size = '5120'; break;
            case 3: $size = '20480'; break;
        }

        return $size;
    }

    public function renderSize()
    {
        $this->sum_size = round(($this->sum_size / 1024) / 1024);    
    }
}
