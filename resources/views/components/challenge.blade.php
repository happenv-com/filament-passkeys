<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
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

                    console.error('Passkey verification failed:', err)
                }
            },
        }"
        x-on:filament-passkeys-challenge-options-ready.window="verify($event.detail.options)"
        @if ($autoStart ?? false)
            data-auto-start
            {{-- Only while nothing has been queued: a challenge redisplayed after a
                 rejected assertion waits for the user, while one shown afresh -- in a
                 reopened modal, say -- starts on its own. --}}
            x-init="
                if (! $wire.$get(@js($getStatePath()))) {
                    $nextTick(() => $el.querySelector('.fi-btn')?.click())
                }
            "
        @endif
        {{ $getExtraAttributeBag()->class(['filament-passkeys-challenge']) }}
    >
        {{ $getAction('verifyWithPasskey') }}
    </div>
</x-dynamic-component>
