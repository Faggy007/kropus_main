<?php

namespace Modules\Calculator\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Calculator\Actions\CleanOldDirectoriesAction;

class CalculatorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CleanOldDirectoriesAction::class
            ]);
        }
    }
}
