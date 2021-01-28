<?php

namespace Core\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:resource {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:resource {resource-name} {context-name}';

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
        $resource_name = $this->argument('name');

        if(Str::endsWith($resource_name, 'Collection')) {
            $stub_path = config('app.layers.core')."Stubs{$ds}ResourceCollection.stub";
        } else {
            $stub_path = config('app.layers.core')."Stubs{$ds}Resource.stub";
        }

        $httpDirectory = $application_path.$context.$ds.'Http';
        $resourcesDirectory = $httpDirectory.$ds.'Resources';
        $filePath = $resourcesDirectory.$ds.$resource_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{resource_name}}', $resource_name,
                    str_replace('{{context}}', $context, $content));

            if(!File::isDirectory($httpDirectory)) {
                File::makeDirectory($httpDirectory);
            }
            if(!File::isDirectory($resourcesDirectory)) {
                File::makeDirectory($resourcesDirectory);
            }
            File::put($filePath, $content);
        } catch(Throwable $e) {
            $this->error($e->getMessage());
        }        

        $this->info($resource_name.' criado com sucesso!');
        
        return 0;
    }
}
