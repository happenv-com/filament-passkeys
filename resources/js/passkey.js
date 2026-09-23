import {
    startAuthentication,
    startRegistration,
} from '@simplewebauthn/browser'

window.FilamentPasskeys = {
    startRegistration,
    startAuthentication,
}
