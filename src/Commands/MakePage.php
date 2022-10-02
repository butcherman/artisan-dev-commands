<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\Command;

class MakePage extends Command
{
    protected $signature   = 'make:page
                            {name : Name of the page to be created}
                            {--optionsApi : If added, the Vue Options API will be suggested rather than the Composistion API}';
    protected $description = 'Create a new Vue Page in the resources/js/Pages folder';

    //  Create the new Page
    public function handle()
    {
        //  Get the name and path the Page will be placed
        $nameArr  = explode('.', $this->argument('name'));
        $basePath = resource_path('js').DIRECTORY_SEPARATOR.'Pages';
        $path     = $basePath.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $nameArr).'.vue';
        $pathInfo = pathinfo($path);

        //  Determine if the /resources/Pages directory exists - if not, create it
        if(!is_dir($basePath))
        {
            mkdir($basePath);
        }

        //  If the page already exists, we will trigger an error
        if(file_exists($path))
        {
            $this->error('This page already exists');
            return 0;
        }

        if(!is_dir($pathInfo['dirname']))
        {
            mkdir($pathInfo['dirname']);
        }

        copy($this->getStub(), $path);
        $this->info('New page created successfully');

        return 0;
    }

    //  Get the stub file for the generator.
    protected function getStub()
    {
        if($this->option('optionsApi'))
        {
            $this->line('options api');
            return  base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/PageStub-Options.stub');
        }

        return base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/PageStub-Setup.stub');
    }
}
