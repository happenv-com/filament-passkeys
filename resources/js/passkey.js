import { startAuthentication, startRegistration } from '@simplewebauthn/browser'
import {
    pageCeremonyIsBlocked,
    pageFailureIsRelatedOrigin,
    pageIsRelatedOrigin,
} from './related-origin.js'

window.FilamentPasskeys = {
    startRegistration,
    startAuthentication,
    isRelatedOrigin: pageIsRelatedOrigin,
    isCeremonyBlocked: pageCeremonyIsBlocked,
    isRelatedOriginFailure: pageFailureIsRelatedOrigin,
}
