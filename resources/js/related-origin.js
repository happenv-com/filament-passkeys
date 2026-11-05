/*
 * Related Origin Requests (WebAuthn Level 3) let a page on one site use passkeys
 * bound to the RP ID of another, provided the RP ID's site lists the page's
 * origin in /.well-known/webauthn. Not every browser or password manager
 * supports it, so on such a page a ceremony may be refused with a SecurityError.
 */

const normalize = (host) =>
    String(host ?? '')
        .trim()
        .toLowerCase()
        .replace(/\.$/, '')

/**
 * Whether a page on `hostname` is a related origin of the RP ID, i.e. the host
 * is neither the RP ID nor one of its subdomains (the only hosts a browser lets
 * use the RP ID without Related Origin Requests).
 */
export function isRelatedOrigin(hostname, rpId) {
    const host = normalize(hostname)
    const rp = normalize(rpId)

    if (host === '' || rp === '') {
        return false
    }

    return host !== rp && !host.endsWith(`.${rp}`)
}

/**
 * Whether a ceremony would be refused up front: the page is a related origin
 * and the browser does not say it supports Related Origin Requests.
 */
export function isCeremonyBlocked({ hostname, rpId, relatedOriginsSupported }) {
    return isRelatedOrigin(hostname, rpId) && relatedOriginsSupported !== true
}

/**
 * Whether a failed ceremony is the SecurityError a client without Related
 * Origin Requests support throws on a related origin.
 */
export function isRelatedOriginFailure(error, hostname, rpId) {
    return error?.name === 'SecurityError' && isRelatedOrigin(hostname, rpId)
}

async function browserSupportsRelatedOrigins() {
    try {
        const capabilities =
            await globalThis.PublicKeyCredential?.getClientCapabilities?.()

        return capabilities?.relatedOrigins === true
    } catch {
        return false
    }
}

/**
 * Browser-bound wrappers: the current page's host is the one that counts.
 */
export const pageIsRelatedOrigin = (rpId) =>
    isRelatedOrigin(globalThis.location?.hostname, rpId)

export const pageFailureIsRelatedOrigin = (error, rpId) =>
    isRelatedOriginFailure(error, globalThis.location?.hostname, rpId)

/**
 * Resolves to true when a ceremony for this RP ID cannot work on this page.
 * Same-site pages resolve to false without asking the browser anything.
 */
export async function pageCeremonyIsBlocked(rpId) {
    if (!pageIsRelatedOrigin(rpId)) {
        return false
    }

    return isCeremonyBlocked({
        hostname: globalThis.location?.hostname,
        rpId,
        relatedOriginsSupported: await browserSupportsRelatedOrigins(),
    })
}
