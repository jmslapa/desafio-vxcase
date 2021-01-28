<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateMiddleware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:middleware {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:middleware {middleware-name} {context-name}';

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
        $stub_path = config('app.layers.core')."Stubs{$ds}Middleware.stub";
        $context = $this->argument('context');
        $middleware_name = $this->argument('name');

        $final_path = $application_path.$context.$ds.'Http'.$ds.'Middleware'
                      .$ds.$middleware_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{middleware_name}}', $middleware_name,
                    str_replace('{{context}}', $context, $content));

            $result = File::put($final_path, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($middleware_name.' criado com sucesso!');
        
        return 0;
    }
}
