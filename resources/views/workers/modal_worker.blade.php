
<div wire:ignore.self class="modal fade" id="modalWorker">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          @if($func == 'create')
            Nowy pracownik
          @else
            Edytuj pracownika / {{ $editWorker['firstname'] }} {{ $editWorker['name'] }}
          @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">

            <div class="mt-1 block w-full h-30 mb-3">
              Pracownika dodaje się na podstawie konta w serwisie.
              Założ najpierw konto lub dodaj istniejące konto za pomocą ustawień przychodni, a następnie dodaj pracownika.
            </div>
    
            <x-jet-label for="worker" value="{{ __('Wybierz konto') }}" />
            @if($func == 'create')
              <select class="form-control" wire:model="worker">
              @forelse($base_users as $tab)
                <option value="{{ $tab['id'] }}">{{ $tab['firstname'] }} {{ $tab['name'] }}</option>
              @empty
                <option value="0">Brak kont.</option>
              @endforelse
              </select>
            @else
              <input class="form-control" value="{{ $editWorker['firstname'] }} {{ $editWorker['name'] }}" readonly/>
            @endif
            <x-jet-input-error for="worker" class="mt-2" />

            <x-jet-label for="schedule" value="{{ __('Wybierz grafik') }}" class="mt-3" />
             <select class="form-control" wire:model="schedule">
            @forelse($base_schedule as $tab)
              <option value="{{ $tab['id'] }}">{{ $tab['name'] }}</option>
            @empty
              <option value="0">Brak szablonów grafików.</option>
            @endforelse
            </select>
            <x-jet-input-error for="schedule" class="mt-2" />

            <x-jet-label for="position" value="{{ __('Stanowisko') }}" class="mt-3" />
            <input id="position" type="text" class="form-control mt-1 block w-full" wire:model.defer="position"/>
            <x-jet-input-error for="position" class="mt-2" />

          </div>
          <div class="col-6">

            <x-jet-label for="title" value="{{ __('Tytuł') }}"/>
            <select class="form-control" wire:model.defer="title">
              <option value="lek.">lek.</option>
              <option value="lek. med.">lek. med.</option>
              <option value="lek. dent.">lek. dent.</option>
              <option value="dr n. med.">dr n. med.</option>
              <option value="dr hab n. med.">dr hab n. med.</option>
              <option value="prof. dr hab. n. med.">prof. dr hab. n. med.</option>
              <option value="Brak tytułu">Brak tytułu</option>
            </select>
            <x-jet-input-error for="title" class="mt-2" />

            <x-jet-label for="specialization" value="{{ __('Specjalizacja') }}" class="mt-3" />
            <select class="form-control" wire:model.defer="specialization">
              <option value="Alergologia">Alergologia</option>
              <option value="Anestezjologia i intensywna terapia">Anestezjologia i intensywna terapia</option>
              <option value="Angiologia">Angiologia</option>
              <option value="Audiologia i foniatria">Audiologia i foniatria</option>
              <option value="Balneologia i medycyna fizykalna">Balneologia i medycyna fizykalna</option>
              <option value="Chirurgia dziecięca">Chirurgia dziecięca</option>
              <option value="Chirurgia klatki piersiowej">Chirurgia klatki piersiowej</option>
              <option value="Chirurgia naczyniowa">Chirurgia naczyniowa</option>
              <option value="Chirurgia ogólna">Chirurgia ogólna</option>
              <option value="Chirurgia onkologiczna">Chirurgia onkologiczna</option>
              <option value="Chirurgia plastyczna">Chirurgia plastyczna</option>
              <option value="Chirurgia szczękowo-twarzowa">Chirurgia szczękowo-twarzowa</option>
              <option value="Choroby płuc">Choroby płuc</option>
              <option value="Choroby płuc dzieci">Choroby płuc dzieci</option>
              <option value="Choroby wewnętrzne">Choroby wewnętrzne</option>
              <option value="Choroby zakaźne">Choroby zakaźne</option>
              <option value="Dermatologia i wenerologia">Dermatologia i wenerologia</option>
              <option value="Diabetologia">Diabetologia</option>
              <option value="Diagnostyka laboratoryjna">Diagnostyka laboratoryjna</option>
              <option value="Endokrynologia">Endokrynologia</option>
              <option value="Endokrynologia ginekologiczna i rozrodczość">Endokrynologia ginekologiczna i rozrodczość</option>
              <option value="Endokrynologia i diabetologia dziecięca">Endokrynologia i diabetologia dziecięca</option>
              <option value="Epidemiologia">Epidemiologia</option>
              <option value="Farmakologia kliniczna">Farmakologia kliniczna</option>
              <option value="Gastroenterologia">Gastroenterologia</option>
              <option value="Gastroenterologia dziecięca">Gastroenterologia dziecięca</option>
              <option value="Genetyka kliniczna">Genetyka kliniczna</option>
              <option value="Geriatria">Geriatria</option>
              <option value="Ginekologia onkologiczna">Ginekologia onkologiczna</option>
              <option value="Hematologia">Hematologia</option>
              <option value="Hipertensjologia">Hipertensjologia</option>
              <option value="Immunologia kliniczna">Immunologia kliniczna</option>
              <option value="Intensywna terapia">Intensywna terapia</option>
              <option value="Kardiochirurgia">Kardiochirurgia</option>
              <option value="Kardiologia">Kardiologia</option>
              <option value="Kardiologia dziecięca">Kardiologia dziecięca</option>
              <option value="Medycyna lotnicza">Medycyna lotnicza</option>
              <option value="Medycyna morska i tropikalna">Medycyna morska i tropikalna</option>
              <option value="Medycyna nuklearna">Medycyna nuklearna</option>
              <option value="Medycyna paliatywna">Medycyna paliatywna</option>
              <option value="Medycyna pracy">Medycyna pracy</option>
              <option value="Medycyna ratunkowa">Medycyna ratunkowa</option>
              <option value="Medycyna rodzinna">Medycyna rodzinna</option>
              <option value="Medycyna sądowa">Medycyna sądowa</option>
              <option value="Medycyna sportowa">Medycyna sportowa</option>
              <option value="Mikrobiologia lekarska">Mikrobiologia lekarska</option>
              <option value="Nefrologia">Nefrologia</option>
              <option value="Nefrologia dziecięca">Nefrologia dziecięca</option>
              <option value="Neonatologia">Neonatologia</option>
              <option value="Neurochirurgia">Neurochirurgia</option>
              <option value="Neurologia">Neurologia</option>
              <option value="Neurologia dziecięca">Neurologia dziecięca</option>
              <option value="Neuropatologia">Neuropatologia</option>
              <option value="Okulistyka">Okulistyka</option>
              <option value="Onkologia i hematologia dziecięca">Onkologia i hematologia dziecięca</option>
              <option value="Onkologia kliniczna">Onkologia kliniczna</option>
              <option value="Ortopedia i traumatologia narządu ruchu">Ortopedia i traumatologia narządu ruchu</option>
              <option value="Otorynolaryngologia">Otorynolaryngologia</option>
              <option value="Otorynolaryngologia dziecięca">Otorynolaryngologia dziecięca</option>
              <option value="Patomorfologia">Patomorfologia</option>
              <option value="Pediatria">Pediatria</option>
              <option value="Pediatria metaboliczna">Pediatria metaboliczna</option>
              <option value="Perinatologia">Perinatologia</option>
              <option value="Położnictwo i ginekologia">Położnictwo i ginekologia</option>
              <option value="Psychiatria">Psychiatria</option>
              <option value="Psychiatria dzieci i młodzieży">Psychiatria dzieci i młodzieży</option>
              <option value="Radiologia i diagnostyka obrazowa">Radiologia i diagnostyka obrazowa</option>
              <option value="Radioterapia onkologiczna">Radioterapia onkologiczna</option>
              <option value="Rehabilitacja medyczna">Rehabilitacja medyczna</option>
              <option value="Reumatologia">Reumatologia</option>
              <option value="Seksuologia">Seksuologia</option>
              <option value="Toksykologia kliniczna">Toksykologia kliniczna</option>
              <option value="Transfuzjologia kliniczna">Transfuzjologia kliniczna</option>
              <option value="Transplantologia kliniczna">Transplantologia kliniczna</option>
              <option value="Urologia">Urologia</option>
              <option value="Urologia dziecięca">Urologia dziecięca</option>
              <option value="Zdrowie publiczne">Zdrowie publiczne</option>
              <option value="Chirurgia stomatologiczna">Chirurgia stomatologiczna</option>
              <option value="Chirurgia szczękowo-twarzowa">Chirurgia szczękowo-twarzowa</option>
              <option value="Ortodoncja">Ortodoncja</option>
              <option value="Periodontologia">Periodontologia</option>
              <option value="Protetyka stomatologiczna">Protetyka stomatologiczna</option>
              <option value="Stomatologia dziecięca">Stomatologia dziecięca</option>
              <option value="Stomatologia zachowawcza z endodoncją">Stomatologia zachowawcza z endodoncją</option>
              <option value="Epidemiologia">Epidemiologia</option>
              <option value="Zdrowie publiczne">Zdrowie publiczne</option>
              <option value="Brak specjalizacji">Brak specjalizacji</option>
            </select>
            <x-jet-input-error for="specialization" class="mt-2" />

            <x-jet-label for="description" value="{{ __('Komentarz') }}" class="mt-3" />
            <textarea id="description" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" style="height:150px;" wire:model.defer="description" /></textarea>
            <x-jet-input-error for="description" class="mt-2" />

          </div>
        </div>

      </div>
      <div class="modal-footer">
      @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
        <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
      @else
          @if($func == 'create')
            @if($count_work <= $pack_work or $pack_work == 0)
              <button wire:click="addWorker" class="btn btn-outline-primary">Zapisz</button>
            @else
            <button class="btn btn-outline-danger" disabled>Został przekroczony limit pracowników dla tej przychodni.</button>
            @endif 
          @else
            <button wire:click="$emit('editSaveWorker', {{ $idEdit }})" class="btn btn-outline-primary">Zapisz</button>
          @endif
      @endif
      </div>
    </div>
  </div>
</div>