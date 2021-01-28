<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Throwable;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:controller {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:controller {controller-name} {context-name}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;
        $application_path = config('app.layers.application');
        $stub_path = config('app.layers.core')."Stubs{$ds}Controller.stub";
        $context = $this->argument('context');
        $controller_name = $this->argument('name');
        
        $httpDirectory = $application_path.$context.$ds.'Http';
        $controllersDirectory = $httpDirectory.$ds.'Controllers';
        $filePath = $controllersDirectory.$ds.$controller_name.'.php';

        try {
            $content = File::get($stub_path);
            $content = str_replace('{{controller_name}}', $controller_name,
                    str_replace('{{context}}', $context, $content));

            if(!File::isDirectory($httpDirectory)) {
                File::makeDirectory($httpDirectory);
            }
            if(!File::isDirectory($controllersDirectory)) {
                File::makeDirectory($controllersDirectory);
            }
            File::put($filePath, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($controller_name.' criado com sucesso!');
        
        return 0;
    }
}
