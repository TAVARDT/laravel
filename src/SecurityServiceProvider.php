<?php

namespace Tavardt\LaravelSecurity;

use Illuminate\Support\ServiceProvider;

/**
 * TAVARDT Laravel Security Service Provider
 * Registers the SecurityHeadersMiddleware automatically.
 */
class SecurityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app['router']->pushMiddlewareToGroup('web', SecurityHeadersMiddleware::class);
        $this->app['router']->pushMiddlewareToGroup('api', SecurityHeadersMiddleware::class);
    }
}
