<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Livewire\WithPagination;
use Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Invoice;


class ShowTableInvoices extends Component
{
	public $user;
    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'desc';


    protected $listeners = ['refreshTableInvoice' => '$refresh'];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
    	//dd($this->resultData());

        return view('settings.table_invoices', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    private function headerConfig()
    {
        return [
            'name' => 'Numer płatności',
            'created_at' => 'Data wygenerowania',
            'sumer' => [
                'label' => 'Koszt netto',
                'func' => function ($value) {
                    return $value.' PLN';
                }
            ],
            'status' => [
                'label' => 'Status',
                'func' => function ($value) {
                    switch($value) {
                    	case 0: return '<span class="badge badge-danger">Anulowana</span>'; break;
                    	case 1: return '<span class="badge badge-primary">Do opłacenia</span>'; break;
                        case 2: return '<span class="badge badge-primary">W trakcie</span>'; break;
                    	case 3: return '<span class="badge badge-success">Opłacona</span>'; break;
                    	case 4: return '<span class="badge badge-info">Zakończona. Faktura wysłana.</span>'; break;
                    }
                }
            ],
        ];
    }   

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return Invoice::where(function ($query) {
            $query->where('team_id', '=', $this->user->current_team_id);

            if($this->searchTerm != "") {
                $query->where('settings', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->select('invoices.*', DB::raw('(SELECT sum(sum) FROM invoices_records WHERE invoice_id = invoices.id) as sumer'))
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }
}
