<?php

namespace Happenv\FilamentMultiFactorPasskeys\Tests;

use Filament\FilamentServiceProvider;
use Filament\Support\SupportServiceProvider;
use Happenv\FilamentMultiFactorPasskeys\MultiFactorPasskeysServiceProvider;
use Happenv\FilamentMultiFactorPasskeys\Tests\Fixtures\TestPanelProvider;
use Happenv\FilamentMultiFactorPasskeys\Tests\Fixtures\User;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelPasskeys\LaravelPasskeysServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            SupportServiceProvider::class,
            FilamentServiceProvider::class,
            LaravelPasskeysServiceProvider::class,
            TestPanelProvider::class,
            MultiFactorPasskeysServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        config()->set('app.key', 'base64:'.base64_encode(random_bytes(32)));

        config()->set('auth.providers.users.model', User::class);
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
