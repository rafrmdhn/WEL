<?php

use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('app:send-daily-report')->daily();

        $schedule->command('contract:send-warnings')->dailyAt('08:00');

        $schedule->command('log:clear')->hourly();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
