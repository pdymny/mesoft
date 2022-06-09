<form wire:submit.prevent="saveSettingsWidget" enctype="multipart/form-data">
  @csrf

  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="switch_widget" wire:model.defer="switch_widget">
    <label class="custom-control-label" for="switch_widget">Czy chcesz korzystać z widgetu?</label>
  </div>

  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="delete_visit_widget" wire:model.defer="delete_visit_widget">
    <label class="custom-control-label" for="delete_visit_widget">Czy chcesz korzystać z możliwości anulowania wizyty?</label>
  </div>

  <div class="mt-3">
    <x-jet-label for="name_widget" value="{{ __('Nazwa wyświetlana w widgecie') }}" />
    <x-jet-input id="name_widget" type="text" class="mt-1 block w-full" wire:model.defer="name_widget" />
    <x-jet-input-error for="name_widget" class="mt-2" />
  </div>

  <div class="mt-3">
    <x-jet-label for="url_widget" value="{{ __('Adres url dla buttona jeśli posiadasz stronę www') }}" />
    <x-jet-input id="url_widget" type="text" class="mt-1 block w-full" wire:model.defer="url_widget" />
    <x-jet-input-error for="url_widget" class="mt-2" />
  </div>

  <button type="submit" class="btn btn-outline-primary float-right mt-3">Zapisz</button>
</form>
