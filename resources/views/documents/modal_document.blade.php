<div wire:ignore.self class="modal fade" id="modalDoc">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Nowy dokument
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form wire:submit.prevent="save">
        <div class="modal-body">

          <input type="file" wire:model="document">
          @error('document') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="modal-footer">
          <div wire:loading wire:target="document" class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
          <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
          @else
            @if($sum_size > $pack_size)
            <button class="btn btn-outline-danger" disabled>Został przekroczony limit danych dla tej przychodni.</button>
            @else
            <button id="adddoc" type="submit" class="btn btn-outline-primary" disabled>Dodaj dokument</button>
            @endif
          @endif
        </div>
      </form>
    </div>
  </div>
</div>