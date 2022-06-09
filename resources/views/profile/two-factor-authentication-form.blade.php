<x-jet-action-section>
    <x-slot name="title">
        {{ __('Uwierzytelnianie dwuskładnikowe') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Dodaj dodatkowe zabezpieczenia do swojego konta, korzystając z uwierzytelniania dwuskładnikowego.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ __('Włączyłeś/aś uwierzytelnianie dwuskładnikowe.') }}
            @else
                {{ __('Nie włączono uwierzytelniania dwuskładnikowego.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Gdy włączone jest uwierzytelnianie dwuskładnikowe, podczas uwierzytelniania zostanie wyświetlony monit o podanie bezpiecznego, losowego tokena. Możesz pobrać ten token z aplikacji Google Authenticator w telefonie.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Uwierzytelnianie dwuskładnikowe jest teraz włączone. Zeskanuj poniższy kod QR za pomocą aplikacji uwierzytelniającej w telefonie.') }}
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Przechowuj te kody odzyskiwania w bezpiecznym menedżerze haseł. Można ich użyć do odzyskania dostępu do konta w przypadku utraty urządzenia do uwierzytelniania dwuskładnikowego.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Włącz') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Regeneruj kody odzyskiwania') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Pokaż kody odzyskiwania') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('Wyłącz') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
