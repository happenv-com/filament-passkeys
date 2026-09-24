<?php

declare(strict_types=1);

/*
 * Every locale translates every key English has — and nothing else. A key
 * missing in one locale silently falls back to English; a key only a
 * translation has is a leftover of a rename.
 */

/**
 * @return array<string, mixed>
 */
function translationKeys(string $file): array
{
    $flatten = static function (array $lines, string $prefix = '') use (&$flatten): array {
        $keys = [];

        foreach ($lines as $key => $value) {
            if (is_array($value)) {
                $keys += $flatten($value, "{$prefix}{$key}.");
            } else {
                $keys["{$prefix}{$key}"] = $value;
            }
        }

        return $keys;
    };

    return $flatten(require $file);
}

dataset('translation files', function (): array {
    $lang = dirname(__DIR__, 2) . '/resources/lang';
    $cases = [];

    // Translation files are nested (e.g. `actions/set-up.php`), so walk the
    // whole English directory rather than its top level only.
    $englishFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("{$lang}/en", FilesystemIterator::SKIP_DOTS));

    foreach ($englishFiles as $english) {
        if ($english->getExtension() !== 'php') {
            continue;
        }

        $relativePath = substr($english->getPathname(), strlen("{$lang}/en/"));

        foreach (glob("{$lang}/*", GLOB_ONLYDIR) ?: [] as $localeDirectory) {
            $locale = basename($localeDirectory);

            if ($locale !== 'en') {
                $cases["{$locale}/{$relativePath}"] = [$english->getPathname(), "{$localeDirectory}/{$relativePath}"];
            }
        }
    }

    ksort($cases);

    return $cases === [] ? ['english only' => [null, null]] : $cases;
});

it('translates every key and nothing else', function (?string $english, ?string $translation): void {
    if ($english === null) {
        expect(true)->toBeTrue();

        return;
    }

    expect($translation)->toBeFile();

    $expected = translationKeys($english);
    $actual = translationKeys($translation);

    expect(array_keys($actual))->toEqualCanonicalizing(array_keys($expected))
        ->and($actual)->each->toBeString()->not->toBeEmpty();
})->with('translation files');
