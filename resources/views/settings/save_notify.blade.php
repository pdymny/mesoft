<form wire:submit.prevent="saveSettingsNotify">
  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="switch_sms" wire:model.defer="switch_sms">
    <label class="custom-control-label" for="switch_sms">Czy chcesz korzystać z powiadomień SMS?</label>
  </div>

  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="switch_email" wire:model.defer="switch_email">
    <label class="custom-control-label" for="switch_email">Czy chcesz korzystać z powiadomień E-mail?</label>
  </div>

  <div class="mt-3">
    <x-jet-label for="sms_clock" value="{{ __('Ilość godzin przed którymi zostanie wysłane powiadomienie SMS?') }}" />
    <x-jet-input id="sms_clock" type="number" min="1" max="1000" class="mt-1 block w-full" wire:model.defer="sms_clock" />
    <x-jet-input-error for="sms_clock" class="mt-2" />
  </div>

  <div class="mt-3">
    <x-jet-label for="email_clock" value="{{ __('Ilość godzin przed którymi zostanie wysłane powiadomienie E-mail?') }}" />
    <x-jet-input id="email_clock" type="number" min="1" max="1000" class="mt-1 block w-full" wire:model.defer="email_clock" />
    <x-jet-input-error for="email_clock" class="mt-2" />
  </div>

  <div class="mt-3">
    <x-jet-label for="sms_text" value="{{ __('Treść wiadomości SMS') }}" />
    <textarea id="sms_text" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" style="height:100px;" wire:model.defer="sms_text" /></textarea>
    <x-jet-input-error for="sms_text" class="mt-2" />
  </div>

  <div class="mt-3">
    <x-jet-label for="email_text" value="{{ __('Treść wiadomości e-mail') }}" />
    <textarea id="email_text" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" style="height:100px;" wire:model.defer="email_text" /></textarea>
    <x-jet-input-error for="email_text" class="mt-2" />
  </div>

  <button class="btn btn-outline-primary float-right mt-3">Zapisz</button>
</form>