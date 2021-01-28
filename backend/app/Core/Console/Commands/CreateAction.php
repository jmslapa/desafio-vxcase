<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateAction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:action {name} {context} {--params=} {--provider=} '
                        .'{--container=} {--repository=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: php artisan create:action {action-name} {context-name} '
                            .'{--params} {--provider} {--container} {--repository=}';

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
        $application_path = config('app.layers.application').'Api'.$ds;
        $context = $this->argument('context');
        $action_name = $this->argument('name');
        $stub_path = config('app.layers.core')."Stubs{$ds}Action.stub";

        $actionsDirectory = $domain_path.$context.$ds.'Actions';
        $filePath = $actionsDirectory.$ds.$action_name.'.php';
        
        try {

            $params = str_replace(':', '$', $this->option('params')) ?? '';
            $repository = $this->option('repository') ? 'app(\'' . Str::camel($this->option('repository')) . '\')' : '';

            $content = File::get($stub_path);
            $content = str_replace('{{context}}', $context, $content);
            $content = str_replace('{{action_name}}', $action_name, $content);
            $content = str_replace('{{params}}', $params , $content);
            $content = str_replace('{{repository}}', $repository, $content);
            $content = $repository ? preg_replace('/\/\/\s/', '', $content, 1) : $content;

            if(!File::isDirectory($actionsDirectory)) {
                File::makeDirectory($actionsDirectory);
            }
            File::put($filePath, $content);

            if($this->option('provider')) {
                $provider_path = $application_path.$context.$ds.'Providers'.$ds.$this->option('provider').'.php';
                if(File::exists($provider_path)) {
                    $camelActionName = Str::camel($action_name);
                    $actionNamespace = str_replace('/', '\\', Str::after(str_replace('.php', '', $filePath), "app"));
                    $providerContent = File::get($provider_path);
                    $afterArea = Str::after(Str::after($providerContent, 'public function registerActions()'), '{');
                    $beforeArea = Str::before($providerContent, $afterArea);
                    $providerNewContent = $beforeArea
                                        ."\n\t\t"."app()->bind('{$camelActionName}', "
                                        ."{$actionNamespace}::class);"
                                        .$afterArea;
                    File::put($provider_path, $providerNewContent);
                } else {
                    throw new \Exception('O provider informado não existe');
                }           
            }

            if($this->option('container')) {
                $container_path = "{$domain_path}{$context}{$ds}ActionsContainers{$ds}{$this->option('container')}.php";
                if(File::exists($container_path)) {
                    $camelActionName = Str::camel($action_name);
                    $actionNamespace = Str::after(str_replace('.php', '', $filePath), "app");
                    $containerContent = File::get($container_path);
                    $insertArea = Str::before($containerContent, Str::after($containerContent, $this->option('container')));
                    if($this->option('provider')) {
                        $containerNewContent = $insertArea
                                            ."\n{\n\t/**"
                                            ."\n\t * Executa a ação $action_name"
                                            ."\n\t *"
                                            ."\n\t * @return mixed"
                                            ."\n\t */"
                                            ."\n\tpublic function $camelActionName({$params})\n"
                                            ."\t{\n\t\t"
                                            ."return app('{$camelActionName}')->execute({$params});"
                                            ."\n\t}\n";
                    } else {
                        $containerNewContent = $insertArea
                                            ."\n{\n\t/**"
                                            ."\n\t * Executa a ação $action_name"
                                            ."\n\t *"
                                            ."\n\t * @return mixed"
                                            ."\n\t */"
                                            ."\n\tpublic function $camelActionName({$params})\n"
                                            ."\t{\n\t\t"
                                            ."//"
                                            ."\n\t}\n";
                    }
                    $containerNewContent = $containerNewContent.Str::after($containerContent, '{');
                    File::put($container_path, $containerNewContent);
                    
                } else {
                    throw new \Exception('O container informado não existe');
                }
            }

            $this->info("A action {$action_name} foi criada com sucesso!");

        } catch(\Throwable $e) {
            $this->error($e->getMessage());
        }
               
        return 0;
    }
}
