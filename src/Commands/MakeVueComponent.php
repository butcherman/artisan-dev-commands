<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\Command;

class MakeVueComponent extends Command
{
    protected $signature   = 'make:vuecomponent
                            {name : Name of the component to be created}
                            {--optionsApi : If added, the Vue Options API will be suggested rather than the Composistion API}';
    protected $description = 'Create a new Vue Component in the resources/js/Components folder';

    //  Create the new Component
    public function handle()
    {
        //  Get the name and path the Component will be placed
        $nameArr  = explode('.', $this->argument('name'));
        $basePath = resource_path('js').DIRECTORY_SEPARATOR.'Components';
        $path     = $basePath.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $nameArr).'.vue';
        $pathInfo = pathinfo($path);

        //  Determine if the /resources/Component directory exists - if not, create it
        if(!is_dir($basePath))
        {
            mkdir($basePath);
        }

        //  If the page already exists, we will trigger an error
        if(file_exists($path))
        {
            $this->error('This component already exists');
            return 0;
        }

        if(!is_dir($pathInfo['dirname']))
        {
            mkdir($pathInfo['dirname']);
        }

        copy($this->getStub(), $path);
        $this->info('New component created successfully');

        return 0;
    }

    //  Get the stub file for the generator.
    protected function getStub()
    {
        $stubName = $this->option('optionsApi') ? 'ComponentStub-Options.stub' : 'ComponentStub-Setup.stub';

        if(file_exists(base_path('stubs/dev_commands/'.$stubName)))
        {
            return base_path('stubs/dev_commands/'.$stubName);
        }

        return base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/'.$stubName);
    }
}
