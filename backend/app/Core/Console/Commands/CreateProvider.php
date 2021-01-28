<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:provider {name} {context}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:provider {provider-name} {context-name}';

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
        $provider_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}Provider.stub";

        $final_path = $application_path.$context.$ds.'Providers'
                      .$ds.$provider_name.'.php';
        
        try {
            $content = File::get($stub_path);
            $content = str_replace('{{provider_name}}', $provider_name,
                    str_replace('{{context}}', $context, $content));

            File::put($final_path, $content);

            $stub_path = config('app.layers.core')."Stubs{$ds}RegisterNewProvider.stub";
            $config_path = config_path('app.php');
            $provider_class = "Application\\Api\\{$context}\\Providers\\{$provider_name}::class";
            $content = File::get($stub_path);
            $content = str_replace('{{provider_class}}', $provider_class, $content);
            $config_content = File::get($config_path);
            $config_content = str_replace('//@new_provider', $content, $config_content);
            File::put($config_path, $config_content);

        } catch(Throwable $e) {
            $this->info($e->getMessage());
        }        

        $this->info($provider_name.' criado com sucesso!');
        
        return 0;
    }
}
