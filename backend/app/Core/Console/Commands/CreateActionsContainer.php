<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateActionsContainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:actions-container {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:actions-container {container-name} {context-name}';

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
        $domain_path = config('app.layers.domain');        
        $context = $this->argument('context');
        $container_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}ActionsContainer.stub";

        $containersDirectory = $domain_path.$context.$ds.'ActionsContainers';
        $filePath = $containersDirectory.$ds.$container_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{container_name}}', $container_name,
                    str_replace('{{context}}', $context, $content));

            if(!File::isDirectory($containersDirectory)) {
                File::makeDirectory($containersDirectory);
            }
            File::put($filePath, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($container_name.' criado com sucesso!');
        
        return 0;
    }
}
