<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            async register(options) {
                if (! window.FilamentPasskeys) {
                    console.error('filament-passkeys assets not loaded')

                    return
                }

                try {
                    const credential = await window.FilamentPasskeys.startRegistration({ optionsJSON: options })

                    // Queue the credential without a round trip, then submit the modal
                    // form again so the action stores the passkey.
                    $wire.$set(@js($getStatePath()), JSON.stringify(credential), false)

                    $el.closest('form')?.requestSubmit()
                } catch (err) {
                    // NotAllowedError is the user dismissing the prompt or letting it time
                    // out, AbortError is the ceremony being called off. Neither is a fault.
                    if (err?.name === 'NotAllowedError' || err?.name === 'AbortError') {
                        return
                    }

                    // The options exclude the user's existing passkeys, so an authenticator
                    // that already holds one refuses to create another.
                    if (err?.name === 'InvalidStateError') {
                        new FilamentNotification()
                            .title(@js(__('filament-passkeys::actions/set-up.notifications.already_registered.title')))
                            .body(@js(__('filament-passkeys::actions/set-up.notifications.already_registered.body')))
                            .warning()
                            .send()

                        return
                    }

                    console.error('Passkey registration failed:', err)
                }
            },
        }"
        x-on:filament-passkeys-registration-options-ready.window="register($event.detail.options)"
        {{ $getExtraAttributeBag() }}
    ></div>
</x-dynamic-component>
