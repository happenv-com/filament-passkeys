<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            notifyUnsupported() {
                new FilamentNotification()
                    .title(@js(__('filament-passkeys::related_origin.unsupported')))
                    .body(@js(__('filament-passkeys::related_origin.set_up_at', ['address' => 'https://' . $rpId])))
                    .warning()
                    .send()
            },
            async register(options) {
                if (! window.FilamentPasskeys) {
                    console.error('filament-passkeys assets not loaded')

                    return
                }

                const rpId = options?.rp?.id ?? @js($rpId)

                // A related origin without Related Origin Requests support cannot create a
                // passkey for this RP ID. Say so instead of letting the browser refuse.
                if (await window.FilamentPasskeys.isCeremonyBlocked(rpId)) {
                    this.notifyUnsupported()

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

                    // A client without Related Origin Requests support refuses the ceremony
                    // on a related origin with a SecurityError.
                    if (window.FilamentPasskeys.isRelatedOriginFailure(err, rpId)) {
                        this.notifyUnsupported()

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
