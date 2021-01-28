<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateException extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:exception {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:exception {exception-name} {context-name}';

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
        $exception_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}Exception.stub";

        $final_path = $application_path.$context.$ds.'Exceptions'
                      .$ds.$exception_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{exception_name}}', $exception_name,
                    str_replace('{{context}}', $context, $content));

            $result = File::put($final_path, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($exception_name.' criado com sucesso!');
        
        return 0;
    }
}
