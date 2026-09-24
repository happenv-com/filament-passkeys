<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use RectorLaravel\Rector\Class_\FillablePropertyToFillableAttributeRector;
use RectorLaravel\Rector\Class_\HiddenPropertyToHiddenAttributeRector;

/*
 * Library, not an application: no privatization and no "treat classes as
 * final" here. Apps extend a plugin's classes and override its protected
 * methods; Rector cannot see those subclasses, so narrowing visibility or
 * finalizing classes would break them without a failing test in this repository.
 */
return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withComposerBased(laravel: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        typeDeclarations: true,
        earlyReturn: true,
    )
    ->withPhpSets()
    // The composer-based Laravel set follows the INSTALLED Laravel (13 locally
    // and in CI), but the package also supports Laravel 12, which has neither
    // the Eloquent #[Fillable] / #[Hidden] attributes nor PreventRequestForgery.
    ->withSkip([
        FillablePropertyToFillableAttributeRector::class,
        HiddenPropertyToHiddenAttributeRector::class,
        RenameClassRector::class,
    ]);
