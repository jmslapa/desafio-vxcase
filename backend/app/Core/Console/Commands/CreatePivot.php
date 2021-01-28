<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreatePivot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:pivot {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:pivot {pivot-name} {context-name}';

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
        $pivot_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}Pivot.stub";

        $final_path = $domain_path.$context.$ds.'Models'
                      .$ds.$pivot_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{pivot_name}}', $pivot_name,
                    str_replace('{{context}}', $context, $content));

            $result = File::put($final_path, $content);
        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($pivot_name.' criado com sucesso!');
        
        return 0;
    }
}
