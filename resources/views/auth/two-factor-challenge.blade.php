<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                {{ __('Potwierdź dostęp do swojego konta, wprowadzając kod uwierzytelniający podany w aplikacji uwierzytelniającej.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                {{ __('Potwierdź dostęp do swojego konta, wprowadzając jeden ze swoich awaryjnych kodów odzyskiwania.') }}
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="/two-factor-challenge">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-label for="code" value="{{ __('Kod') }}" />
                    <x-jet-input id="code" class="block mt-1 w-full" type="text" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-label for="recovery_code" value="{{ __('Kod odzyskiwania') }}" />
                    <x-jet-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Użyj kodu odzyskiwania') }}
                    </button>

                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Użyj kodu uwierzytelniającego') }}
                    </button>

                    <x-jet-button class="ml-4">
                        {{ __('Zaloguj się') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
