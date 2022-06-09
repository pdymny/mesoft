<form wire:submit.prevent="sendMailing">
  @csrf

  <div class="form-check">
    <input class="form-check-input" type="radio" name="send" id="send_email" value="email" wire:model="send">
    <label class="form-check-label" for="send_email">
      Wyślij masowe wiadomości e-mail.
    </label>
  </div>

  <div class="form-check">
    <input class="form-check-input" type="radio" name="send" id="send_sms" value="sms" wire:model="send">
    <label class="form-check-label" for="send_sms">
      Wyślij masowe wiadomości sms.
    </label>
  </div>

  <x-jet-label for="text" value="{{ __('Treść wiadomości') }}" class="mt-3" />
  <textarea id="text" type="text" class="form-control rounded-md shadow-sm mt-1 block w-full" style="height:150px;" wire:model="text" /></textarea>
  <x-jet-input-error for="text" class="mt-2" />

    @if($user->currentTeam->pack_email >= $count or $user->currentTeam->pack_sms >= $count)
    <button type="submit" class="btn btn-outline-primary float-right mt-3">Wyślij {{ $count }} wiadomości {{ $send }}</button>
    @else
      <button type="button" class="btn btn-danger float-right mt-3" disabled>Brak punktów.</button>
    @endif
</form>
