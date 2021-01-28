<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateContext extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:context {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:context {context-name}';

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
        $domain_path = config('app.layers.domain');
        $context_name = $this->argument('name');

        try {
            // Application Layer
            if(!File::makeDirectory($application_path.$context_name)) {
                throw new \Exception('Criação de '.$context_name.' em Application falhou.');
            }
            $context_directory = $application_path.$context_name.$ds;

            if(!File::makeDirectory($context_directory.'Exceptions')) {
                throw new \Exception('Criação de Exceptions em '.$context_directory.' falhou.');
            }
            if(!File::makeDirectory($context_directory.'Providers')) {
                throw new \Exception('Criação de Providers em '.$context_directory.' falhou.');
            }
            if(!File::makeDirectory($context_directory.'Http')) {
                throw new \Exception('Criação de Http em '.$context_directory.' falhou.');
            }
            $http_directory = $context_directory.'Http'.$ds;

            if(!File::makeDirectory($http_directory.'Controllers')) {
                throw new \Exception('Criação de Controllers em '.$http_directory.' falhou.');
            }
            if(!File::makeDirectory($http_directory.'Middleware')) {
                throw new \Exception('Criação de Middleware em '.$http_directory.' falhou.');
            }
            if(!File::makeDirectory($http_directory.'Resources')) {
                throw new \Exception('Criação de Resources em '.$http_directory.' falhou.');
            }
            if(!File::makeDirectory($http_directory.'ResourceFactories')) {
                throw new \Exception('Criação de Factories em '.$http_directory.' falhou.');
            }
            if(!File::makeDirectory($http_directory.'Validators')) {
                throw new \Exception('Criação de Validators em '.$http_directory.' falhou.');
            }

            // Domain Layer
            File::makeDirectory($domain_path.$context_name);
            $context_directory = $domain_path.$context_name.$ds;

            if(!File::makeDirectory($context_directory.'Actions')) {
                throw new \Exception('Criação de Actions em '.$context_directory.' falhou.');
            }
            if(!File::makeDirectory($context_directory.'ActionsContainers')) {
                throw new \Exception('Criação de Containers em '.$context_directory.' falhou.');
            }
            if(!File::makeDirectory($context_directory.'Models')) {
                throw new \Exception('Criação de Models em '.$context_directory.' falhou.');
            }
            if(!File::makeDirectory($context_directory.'Repositories')) {
                throw new \Exception('Criação de Repositories em '.$context_directory.' falhou.');
            }           

            $this->info('Novo contexto '.$context_name.' criado com sucesso.');
        
        } catch(\Throwable $e) {
            $this->error($e->getMessage());
        }

        return 0;
    }
}
