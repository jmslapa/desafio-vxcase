<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateResourceFactory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:resource-factory {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:resource-factory {factory-name} {context-name}';

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
        $context = $this->argument('context');
        $factory_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}ResourceFactory.stub";
        $factoriesDirectory = $application_path.$context.$ds.'Http'.$ds.'ResourceFactories';
        $filePath = $factoriesDirectory.$ds.$factory_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{factory_name}}', $factory_name,
                    str_replace('{{context}}', $context, $content));

            if(!File::isDirectory($factoriesDirectory)) {
                File::makeDirectory($factoriesDirectory);
            }
            File::put($filePath, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($factory_name.' criado com sucesso!');
        
        return 0;
    }
}
