<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\Command;

class MakeForm extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:form
                            {name : Name of form to be created}
                            {--optionsApi : If added, the vue Options API will be suggested rather than Composition API}';

    /**
     * @var string
     */
    protected $description = 'Create a new blank form template in the resources/js/Forms folder';

    /**
     * Create a new blank form in the /resources/js/Forms folder.  Create all
     * directories as needed
     */
    public function handle()
    {
        //  Get the name and path the Page will be placed
        $nameArr  = explode('.', $this->argument('name'));
        $basePath = resource_path('js') . DIRECTORY_SEPARATOR . 'Forms';
        $path     = $basePath . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $nameArr) . '.vue';
        $pathInfo = pathinfo($path);

        //  Determine if the /resources/Forms directory exists - if not, create it
        if (!is_dir($basePath)) {
            mkdir($basePath);
        }

        //  If the form already exists, we will trigger an error
        if (file_exists($path)) {
            $this->error('A form with this name already exists');
            return 0;
        }

        if (!is_dir($pathInfo['dirname'])) {
            mkdir($pathInfo['dirname'], 0775, true);
        }

        copy($this->getStub(), $path);
        $this->info('New form created successfully');

        return 0;
    }

    //  Get the stub file for the generator.
    protected function getStub()
    {
        $stubName = $this->option('optionsApi') ? 'FormStub-Options.stub' : 'FormStub-Setup.stub';

        if (file_exists(base_path('stubs/dev_commands/' . $stubName))) {
            return base_path('stubs/dev_commands/' . $stubName);
        }

        return base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/' . $stubName);
    }
}
