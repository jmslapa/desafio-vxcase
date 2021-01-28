<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateValidator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:validator {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:validator {validator-name} {context-name}';

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
        $validator_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}Validator.stub";
        $httpDirectory = $application_path.$context.$ds.'Http';
        $validatorsDirectory = $httpDirectory.$ds.'Validators';
        $filePath = $validatorsDirectory.$ds.$validator_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{validator_name}}', $validator_name,
                    str_replace('{{context}}', $context, $content));

            if(!File::isDirectory($httpDirectory)) {
                File::makeDirectory($httpDirectory);
            }
            if(!File::isDirectory($validatorsDirectory)) {
                File::makeDirectory($validatorsDirectory);
            }
            File::put($filePath, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($validator_name.' criado com sucesso!');
        
        return 0;
    }
}
