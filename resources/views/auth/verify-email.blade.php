<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Dziękujemy za zarejestrowanie się! Czy przed rozpoczęciem możesz zweryfikować swój adres e-mail, klikając link, który właśnie wysłaliśmy do Ciebie e-mailem? Jeśli nie otrzymałeś e-maila, z przyjemnością prześlemy Ci kolejny.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Nowy link weryfikacyjny został wysłany na adres e-mail podany podczas rejestracji.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Wyślij ponownie e-mail weryfikacyjny') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Wyloguj się') }}
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
