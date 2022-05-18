<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakePage extends Command
{
    protected $name         = 'make:page';
    protected  $description = 'Create a new Vue Page in the resources/js/Pages folder';


    //  Create the new Page
    public function handle()
    {
        //  Get the name and path the Page will be placed
        $nameArr  = explode('.', $this->argument('name'));
        $basePath = resource_path('js').DIRECTORY_SEPARATOR.'Pages';
        $path     = $basePath.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $nameArr).'.vue';
        $pathInfo = pathinfo($path);

        if(file_exists($path))
        {
            $this->error('This page already exists');
            return 0;
        }

        if(!is_dir($pathInfo['dirname']))
        {
            mkdir($pathInfo['dirname']);
        }

        // file_put_contents($path, $this->getStub());
        copy($this->getStub(), $path);
        $this->info('New page created successfully');
    }

    //  Get the stub file for the generator.
    protected function getStub()
    {
        return  base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/PageStub.stub');
    }

    //  Get the console command arguments
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the page to create'],
        ];
    }
}
