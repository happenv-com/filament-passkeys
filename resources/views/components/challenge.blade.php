<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            // On a related origin the passkey stays out of reach until the browser has
            // confirmed it supports Related Origin Requests. Same-site pages are never held.
            unsupported: window.FilamentPasskeys?.isRelatedOrigin(@js($rpId)) ?? false,
            async verify(options) {
                if (! window.FilamentPasskeys) {
                    console.error('filament-passkeys assets not loaded')

                    return
                }

                try {
                    const assertion = await window.FilamentPasskeys.startAuthentication({ optionsJSON: options })

                    // Queue the assertion without a round trip, then submit the challenge
                    // form so Filament validates it together with the rest of the login.
                    $wire.$set(@js($getStatePath()), JSON.stringify(assertion), false)

                    $el.closest('form')?.requestSubmit()
                } catch (err) {
                    // NotAllowedError is the user dismissing the prompt or letting it time
                    // out, AbortError is the ceremony being called off. Neither is a fault.
                    if (err?.name === 'NotAllowedError' || err?.name === 'AbortError') {
                        return
                    }

                    // A client without Related Origin Requests support refuses the ceremony
                    // on a related origin with a SecurityError.
                    if (window.FilamentPasskeys.isRelatedOriginFailure(err, @js($rpId))) {
                        this.unsupported = true

                        return
                    }

                    console.error('Passkey verification failed:', err)
                }
            },
        }"
        x-on:filament-passkeys-challenge-options-ready.window="verify($event.detail.options)"
        @if ($autoStart ?? false)
            data-auto-start
        @endif
        {{-- A related origin waits for the browser to confirm Related Origin Requests
             support. A challenge that starts on its own only does so once the passkey
             is known to work, and only while nothing has been queued: one redisplayed
             after a rejected assertion waits for the user, while one shown afresh --
             in a reopened modal, say -- starts on its own. --}}
        x-init="
            unsupported = (await window.FilamentPasskeys?.isCeremonyBlocked(@js($rpId))) ?? false

            @if ($autoStart ?? false)
                if (! unsupported && ! $wire.$get(@js($getStatePath()))) {
                    $nextTick(() => $el.querySelector('.fi-btn')?.click())
                }
            @endif
        "
        {{ $getExtraAttributeBag()->class(['filament-passkeys-challenge']) }}
    >
        <div x-show="! unsupported">
            {{ $getAction('verifyWithPasskey') }}
        </div>

        <div
            x-show="unsupported"
            x-cloak
            class="filament-passkeys-unsupported"
            role="alert"
        >
            <p>
                {{ __('filament-passkeys::related_origin.unsupported') }}
                @unless ($onlyMethod ?? false)
                    {{ __('filament-passkeys::related_origin.choose_another') }}
                @endunless
            </p>

            @if ($onlyMethod ?? false)
                <p>
                    {{ new \Illuminate\Support\HtmlString(__('filament-passkeys::related_origin.sign_in_at', ['address' => '<a href="' . e('https://' . $rpId) . '" class="underline">' . e($rpId) . '</a>'])) }}
                </p>
            @endif
        </div>
    </div>
</x-dynamic-component>
