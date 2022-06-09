<form wire:submit.prevent="save">

  @if ($logo_widget)
    <img src="{{ $logo_widget->temporaryUrl() }}" class="p-2">
  @endif

  <input type="file" wire:model="logo_widget">
  @error('logo_widget') <span class="error">{{ $message }}</span> @enderror

  <div wire:loading wire:target="logo_widget" class="spinner-border spinner-border-sm" role="status">
    <span class="sr-only">Loading...</span>
  </div>
  @if(Auth::user()->currentTeam->id_pack > 0 and Auth::user()->currentTeam->pack_term < Carbon::now())
  <button class="btn btn-outline-danger" disabled>Posiadasz nieaktywny pakiet.</button>
  @else
  <button id="adddoc" type="submit" class="btn btn-outline-primary" disabled>Dodaj logo</button>
  @endif

</form>