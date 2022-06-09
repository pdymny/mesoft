<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use Illuminate\Http\Request;

class NavBeamInfo extends Component
{
	public $user;
	public $name_pack;

    public $help_title;
    public $help_text;


	public function mount(Request $request)
	{
		$this->user = Auth::user();

		$this->packing($this->user->currentTeam->id_pack);
        $this->helpSwitch($request->path());
	}

    public function render()
    {
        return view('nav_beam_info');
    }

    private function packing($id)
    {
    	switch($id) {
    		case 0: 
    			$name = 'Darmowy'; 
    		break;
    		case 1:
    			$name = 'Mini';
    		break;
    		case 2:
    			$name = 'Medium';
    		break;
    		case 3:
    			$name = 'Maxi';
    		break;
    		default:
    			$name = 'Error';
    		break;
    	}

    	$this->name_pack = $name;
    }

    private function helpSwitch($path) 
    {

        switch($path) {
            default:
                $this->help_title = 'Błąd';
                $this->help_text = 'Dla tej podstrony nie ma pomocy lub jest w przygotowywaniu.';
            break;
            case 'dashboard':
                $this->help_title = 'Pulpit';
                $this->help_text = 'Na pulpicie wyświetlają się wizyty, które zaplanowane są na dzisiaj oraz możesz dodać nową wiytę w szybki sposób za pomocą przycisku <b>Nowa wizyta</b>. Oprócz tego poniżej są dostępne karteczki, które możesz zostawiać dla innych współpracowników, czy też po prostu notować jakieś informacje. Klinkij <b>Nowa kartka</b>, aby dodać.';
            break;
            case 'communicator':
                $this->help_title = 'Komunikatora';
                $this->help_text = 'Komunikator pozwala na kontaktowanie się z współpracownikami. Jest on tak zaprojektowany, aby można było kontaktować się za pomocą niego z kilkoma zespołami jednocześnie. Wybierz przychodnię, wybierz osoby z którymi chcesz się skontaktować, wpisz temat, treść i wyślij.';
            break;            
            case 'visits':
                $this->help_title = 'Wizyty';
                $this->help_text = 'Tutaj znajdziesz wszystkie wizyty jakie zostały dodane dla danej przychodni. Możesz dodać, usunąć, czy zarządzać daną wizytą. Do dyspozycji jest również wyszukiwarka, która w dynamiczny sposób przeszuka całą bazę. Oprócz tego są również filtry.';
            break;
            case 'patients':
                $this->help_title = 'Pacjentów';
                $this->help_text = 'Tutaj znajdziesz wszystkich pacjentów z Twojej przychodni. Możesz ich dodawać, usuwać, zarządzać nimi, a także masz dostęp do karty pacjenta. Za pomocą opcji <b>Zarządzania</b> możesz dodać nową wizytę dla pacjenta, czy też wysłać do niego wiadomość sms, czy e-mail jeśli pozostawił dane kontaktowe.';
            break;
            case 'workers':
                $this->help_title = 'Pracowników';
                $this->help_text = 'Tutaj znajdziesz listę pracowników danej przychodni. Przed dodaniem nowego pracownika należy założyć dla niego konto w seriwsie, a następnie dodać konto do przychodni. Wtedy można już dodać pracownika w tym miejcu. Ma to na celu danie możliwości udziału pracownikowi za pomocą jednego kotna w wielu przychodniach.';
            break;
            case 'services':
                $this->help_title = 'Usług';
                $this->help_text = 'Lista usług, którą wykonuje Twoja przychodnia. Możesz dodać usługi i w ten sposób w łatwy sposób podczas wizyty wyświetla Ci sie czas i koszt usługi. Pomaga również w planowaniu wizyt naszemu systemowi.';
            break;
            case 'documents':
                $this->help_title = 'Dokumentów';
                $this->help_text = 'Prosta lista dokumentów wszystkich pacjentów w przychodni wraz z wyszukiwarką, aby szybko dostać się do poszukiwanego dokumentu.';
            break;
            case 'settings':
                $this->help_title = 'Ustawień';
                $this->help_text = 'Tutaj znajdziesz dostęp do ustawień przychodni, grafików pracy, historii wykonanych akcji w przychodni przez pracowników, dostęp do płatności, czy ustawienia widgetu i wysyłanych powiadomień.';
            break;
            case 'work-schedule':
                $this->help_title = 'Grafików pracy';
                $this->help_text = 'Grafiki pracy to bardzo ważne ustawienia dla naszego systemu. Przelicza on kiedy dany pracownik może pracować i na tej podstawie ustala możliwe wizyty. Wykonaj grafik i przypisz pracownikowi.';
            break;          
            case 'stocks':
                $this->help_title = 'Historii akcji';
                $this->help_text = 'Tutaj znajdziesz akcje, które zostały wykoane przez konta dodane do danej przychodni. Sprawdzaj co jakiś czas, a dzięki temu będziesz wiedzieć, czy ktoś wykonał jakieś nietypowe akcje.';
            break;
            case 'payments':
                $this->help_title = 'Płatności';
                $this->help_text = 'Kończy Ci się pakiet lub chcesz nowy. Jesteś w dobrym miejscu. Najpierw uzupełnij swoje dane do faktury, a następnie wybierz pakiet i wygeneruj fakturę. Opłać i czekaj na aktywację.';
            break;
            case 'widget-notify':
                $this->help_title = 'Ustawień widgetu i powiadomień';
                $this->help_text = 'Widget to mała strona pozwalająca na dokonanie zamówienia wizyty przez klienta lub jej anulowanie. W tym miejscu możesz również zmienić ustawienia powiadomień wiadomości sms i e-mail.';
            break;
            case 'recommend':
                $this->help_title = 'Poleceń';
                $this->help_text = 'Tutaj znajdziesz system poleceń dla naszej aplikacji.';
            break;
            case 'terms':
                $this->help_title = 'Terminarze';
                $this->help_text = "Sprawdzaj terminarze pracowników.";
            break;
            case 'marketing':
                $this->help_title = 'Marketing';
                $this->help_text = "Dodawaj regułki programu lojalnościowego, wysyłaj wiadomości masowe e-mail jak i sms.";
            break;
        }
    }
}
