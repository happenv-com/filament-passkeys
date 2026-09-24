import * as esbuild from 'esbuild'

/*
 * Builds the package's assets into resources/dist, which is committed and
 * served by Filament as is (see FilamentAsset registration in the service
 * provider). CI rebuilds and fails when the committed files differ.
 *
 *   npm run build   one minified build
 *   npm run dev     rebuild on change, with inline source maps
 *
 * Add an entry per asset: JavaScript is bundled for the browser, CSS files
 * are bundled too (their @imports inlined).
 */
const entries = [
    { in: 'resources/js/passkey.js', out: 'passkey' },
    { in: 'resources/css/passkey.css', out: 'passkey' },
]

const isDev = process.argv.includes('--dev')

const context = await esbuild.context({
    entryPoints: entries,
    outdir: 'resources/dist',
    bundle: true,
    // A classic script: Filament loads passkey.js with a plain <script> tag, and
    // the bundle exposes its API as window.FilamentPasskeys.
    format: 'iife',
    platform: 'browser',
    target: ['es2020'],
    minify: !isDev,
    sourcemap: isDev ? 'inline' : false,
    sourcesContent: isDev,
    logLevel: 'info',
})

if (isDev) {
    await context.watch()
} else {
    await context.rebuild()
    await context.dispose()
}
