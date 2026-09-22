<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            async verify(options) {
                if (! window.FilamentMultiFactorPasskeys) {
                    console.error('filament-multifactor-passkeys assets not loaded')

                    return
                }

                try {
                    const assertion = await window.FilamentMultiFactorPasskeys.startAuthentication({ optionsJSON: options })

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
        x-on:filament-multifactor-passkeys-challenge-options-ready.window="verify($event.detail.options)"
        {{ $getExtraAttributeBag()->class(['fmfp-challenge']) }}
    >
        {{ $getAction('verifyWithPasskey') }}
    </div>
</x-dynamic-component>
