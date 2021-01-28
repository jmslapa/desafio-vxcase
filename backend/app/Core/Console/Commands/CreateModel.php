<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:model {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:model {model-name} {context-name}';

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
        $model_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}Model.stub";

        $final_path = $domain_path.$context.$ds.'Models'
                      .$ds.$model_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{model_name}}', $model_name,
                    str_replace('{{context}}', $context, $content));

            $result = File::put($final_path, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($model_name.' criado com sucesso!');
        
        return 0;
    }
}
