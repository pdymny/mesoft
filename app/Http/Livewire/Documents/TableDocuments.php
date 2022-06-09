<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

use App\Models\Document;

use App\Notifications\NotifyUser;

class TableDocuments extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $patient;

	protected $listeners = ['removeDoc' => 'removeDoc', 
							'donwloadDoc' => 'donwloadDoc',
							'showDoc' => 'showDoc',
							'ShowTableDocumentsRefresh' => '$refresh'];

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    private function headerConfig()
    {
        if(!empty($this->patient)) {
            return [
                'name' => 'Nazwa',
                'size' => [
                    'label' => 'Rozmiar',
                    'func' => function ($value) {
                    	$value = $value / 1024;
                    	if($value > 1024) {
                        	return round($value / 1024).' MB';
                        } else {
                        	return round($value).' KB';
                        }
                    }
                ],
                'created_at' => 'Data dodania',
            ];
        } else {
            return [
                'name' => 'Nazwa',
                'firstname' => 'Imię pacjenta',
                'p_name' => 'Nazwisko pacjenta',
                'size' => [
                    'label' => 'Rozmiar',
                    'func' => function ($value) {
                        $value = $value / 1024;
                        if($value > 1024) {
                            return round($value / 1024).' MB';
                        } else {
                            return round($value).' KB';
                        }
                    }
                ],
                'created_at' => 'Data dodania',
            ];     
        }
    }   

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return Document::where(function ($query) {
            $query->where('teams_documents.team_id', '=', $this->user->current_team_id);
            if(!empty($this->patient)) {
                $query->where('teams_documents.patient_id', '=', $this->patient->id);
            }
            if($this->searchTerm != "") {
               $query->where('teams_documents.name', 'like', '%'.$this->searchTerm.'%');
               $query->orWhere('teams_documents.created_at', 'like', '%'.$this->searchTerm.'%');
               $query->orWhere('teams_patients.firstname', 'like', '%'.$this->searchTerm.'%');
               $query->orWhere('teams_patients.name', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->join('teams_patients', 'teams_documents.patient_id', '=', 'teams_patients.id')
        ->select('teams_documents.created_at as created_at', 'teams_documents.name', 'teams_documents.size', 'teams_patients.firstname', 'teams_patients.name as p_name', 'teams_documents.id as did')
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }

    public function render()
    {
        return view('documents.table_documents', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    public function removeDoc(Document $doc) 
    {
    	Storage::delete($doc->path);

    	$doc->delete();

        $this->user->notify(new NotifyUser('Dokument o nazwie <i>'.$doc->name.'</i> został usunięty.'));
    }

    public function donwloadDoc(Document $doc)
    {
    	return Storage::download($doc->path);
    }

}
