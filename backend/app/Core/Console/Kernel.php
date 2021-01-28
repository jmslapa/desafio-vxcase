<?php

namespace Core\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Core\Console\Commands\CreateContext::class,
        \Core\Console\Commands\CreateController::class,
        \Core\Console\Commands\CreateMiddleware::class,        
        \Core\Console\Commands\CreateResource::class,        
        \Core\Console\Commands\CreateValidator::class,               
        \Core\Console\Commands\CreateException::class,               
        \Core\Console\Commands\CreateProvider::class,               
        \Core\Console\Commands\CreateAction::class,
        \Core\Console\Commands\CreateActionsContainer::class,
        \Core\Console\Commands\CreateResourceFactory::class,
        \Core\Console\Commands\CreateModel::class,
        \Core\Console\Commands\CreateRepository::class,
        \Core\Console\Commands\CreatePivot::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
